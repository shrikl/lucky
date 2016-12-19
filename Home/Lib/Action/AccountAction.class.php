<?php
	class AccountAction extends CommonAction{
		/* ---------------------------------↓↓↓↓↓↓------------------------------------ */
		public function index() {
			$d = date('Y-m-d')." 12:00:00";
			$s = strtotime($d);
			$ntime = time();
			if($ntime >= $s) {
				$e = $s + 86400;
				$data['stime']  = array(array('gt', $s), array('lt', $e));
				$data['actual'] = array(array('elt', 0));
			}else if($ntime < $s) {
				$e = $s - 86400;
				$data['stime']  = array(array('gt', $e), array('lt', $s));
				$data['actual'] = array(array('elt', 0));
			}
			
			$m   = D("Account");
			$arr = $m->relation(true)->where($data)->order('stime')->select();
			
			if($arr) {
				$this->assign("accountList", $arr);
			}else{
				$this->assign("accountList", 0);
			}

			$this->display();
		}
		/* ---------------------------------↑↑↑↑↑↑------------------------------------ */
		/* ---------------------------------↓↓↓↓↓↓------------------------------------ */
		public function newOrder() {
			if(!$this->isPost()) {
				$this->redirect("Account/index");
			}

			$m = D("Account");
			$m->create();
			$c = $m->add();
			if($c) {
				$this->redirect("Account/index");
			}else{
				$this->error("新增订单失败!");
			}
		}
		/* ---------------------------------↑↑↑↑↑↑------------------------------------ */
		public function getSettleAccount() {
			$id = $_GET['id'];
			$vipcard = $_GET['vipcard'];

			$m   = D('Account');
			$arr = $m->where('id='.$id)->find();

			$arr['vipcard'] = $vipcard;

			$etime = time();
			if($arr['tnumber'] == "888") {
				$total = calculateBF($arr, $etime);
			}else{
				$total = calculateDT($arr, $etime);
			}

			$stime = $arr['stime'];
			$sc    = transform($etime - $stime);

			$data['etime'] = $etime;
			$data['total'] = $total;
			$c             = $m->where('id='.$id)->save($data);

			$rarr['total'] = $total;
			$rarr['sc']    = $sc;
			if($c) {
				$this->ajaxReturn($rarr);
			}else{
				$this->ajaxReturn("error");
			}
		}
		public function getAdvanceSettleAccount() {
			$id = $_GET['id'];
			$p  = $_GET['p']; //先走总人数
			$v  = $_GET['v']; //先走会员人数
			$y2s = $_GET['y2s'];
			$y4s = $_GET['y4s'];
			$vipcard = $_GET['vipcard'];

			$m   = D('Account');
			$arr = $m->where('id='.$id)->find();
			
			$etime           = time();
			$carr['stime']   = $arr['stime'];
			$carr['pnumber'] = $p;
			$carr['vnumber'] = $v;
			$carr['y2s']     = $y2s;
			$carr['y4s']     = $y4s;
			$carr['vipcard'] = $vipcard;
			if($arr['tnumber'] == "888") {
				$total = "包房部分人提前走不用结账";
			}else{
				$total = calculateDT($carr, $etime);
			}
			
			$stime = $arr['stime'];
			$sc    = transform($etime - $stime);

			$aarr['etime']   = $etime;
			$aarr['total']   = $total;
			$aarr['pnumber'] = $arr['pnumber'];
			$aarr['vnumber'] = $arr['vnumber'];
			$aarr['sc']      = $sc;

			$this->ajaxReturn($aarr);
		}
		public function settleAccount() {
			if(!$this->isPost()) {
				$this->redirect("Account/index");
			}

			$actual  = $_POST['settleAccountActual'];
			$id      = $_POST['settleAccountId'];
			$payment = $_POST['settleAccountPayment'];

			$m = D('Account');

			$data['actual']  = $actual;
			$data['payment'] = $payment;
			$data['cid']     = $_SESSION['username'];

			$c = $m->where('id='.$id)->save($data);

			if($c) {
				$this->redirect("Account/index");
			}else{
				$this->error("error");
			}
		}
		public function todayAccount() {
			$m = D('Account');
			
			$d = date('Y-m-d')." 12:00:00";
			$s = strtotime($d);
			$ntime = time();
			if($ntime >= $s) {
				$e = $s + 86400;
				$data['stime']  = array(array('gt', $s), array('lt', $e));
				$data['actual'] = array(array('gt', 0));
			}else if($ntime < $s) {
				$e = $s - 86400;
				$data['stime']  = array(array('gt', $e), array('lt', $s));
				$data['actual'] = array(array('gt', 0));
			}

			$arr     = $m->relation(true)->where($data)->select();
			$tmoney  = $m->where($data)->sum('total');
			$amoney  = $m->where($data)->sum('actual');
			$pnumber = $m->where($data)->sum('pnumber');
			$vnumber = $m->where($data)->sum('vnumber');
			$y2n     = $m->where($data)->sum('y2s');
			$y4n     = $m->where($data)->sum('y4s');

			$data['payment'] = array(array('eq', 1));
			$xpay    = $m->where($data)->sum('actual');
			if(!$xpay) $xpay = 0;
			$data['payment'] = array(array('eq', 2));
			$wpay    = $m->where($data)->sum('actual');
			if(!$wpay) $wpay = 0;
			$data['payment'] = array(array('eq', 3));
			$zpay    = $m->where($data)->sum('actual');
			if(!$zpay) $zpay = 0;

			if($arr) {
				$this->assign('xpay', $xpay);
				$this->assign('wpay', $wpay);
				$this->assign('zpay', $zpay);
				$this->assign('y2n', $y2n);
				$this->assign('y4n', $y4n);
				$this->assign('tmoney', $tmoney);
				$this->assign('amoney', $amoney);
				$this->assign('pnumber', $pnumber);
				$this->assign('vnumber', $vnumber);
				$this->assign('accountList', $arr);
			}else{
				$this->assign('accountList', "0");
			}
			$this->display();
		}
		public function deleteAccount() {
			if(!$this->isPost()) {
				$this->redirect("Account/index");
			}
			$id = $_POST['deleteAccountId'];
			$m  = D('Account');
			$c  = $m->where('id='.$id)->delete();
			if($c) {
				$this->redirect("Account/index");
			}else{
				$this->error("error");
			}

		}
		public function modifyWater() {
			$id = $_GET['id'];
			$y  = $_GET['y'];
			$n  = $_GET['n'];
			if($y == 2) {
				$data['y2s'] = $n;
			}else if($y == 4) {
				$data['y4s'] = $n;
			}
			$m = D('Account');
			$c = $m->where('id='.$id)->save($data);
			if($c) {
				$this->redirect("Account/index");
			}else{
				$this->error("error");
			}
		}
		public function advanceSettleAccount() {
			$id      = $_POST['advanceSettleAccountId'];
			$xzrs    = $_POST['advanceSettleAccountPnumber'];
			$ays     = $_POST['advanceSettleAccountYs'];
			$ass     = $_POST['advanceSettleAccountActual'];
			$xzvn    = $_POST['advanceSettleAccountVnumber'];
			$aetime  = $_POST['advanceSettleAccountEtime'];
			$payment = $_POST['advanceSettleAccountPayment'];
			$y2s     = $_POST['advanceSettleAccount2y'];
			$y4s     = $_POST['advanceSettleAccount4y'];

			$m = D('Account');
			$arr = $m->where('id='.$id)->find();

			$data['oid'] = $arr['oid'];
			$data['uid'] = $arr['uid'];
			$data['cid'] = $_SESSION['username'];

			$data['stime']   = $arr['stime'];
			$data['etime']   = $aetime;
			$data['pnumber'] = $xzrs;
			$data['vnumber'] = $xzvn;
			$data['tnumber'] = $arr['tnumber'];
			$data['y2s'] = $y2s;
			$data['y4s'] = $y4s;
			$data['total']   = $ays;
			$data['actual']  = $ass;
			$data['payment'] = $payment;

			$dataa['pnumber'] = $arr['pnumber'] - (int)$xzrs;
			$dataa['vnumber'] = $arr['vnumber'] - (int)$xzvn;
			$dataa['y2s'] = $arr['y2s'] - (int)$y2s;
			$dataa['y4s'] = $arr['y4s'] - (int)$y4s;

			$c1 = $m->add($data);
			$c2 = $m->where('id='.$id)->save($dataa);
			if($c1 && $c2) {
				$this->redirect("Account/index");
			}else{
				$this->error("error");
			}
		}
		public function historyAccount() {
			$sdate = $_POST['historyAccountSdate'];
			$edate = $_POST['historyAccountEdate'];
			
			$stime = strtotime($sdate." 00:00:00");
			$etime = strtotime($edate." 24:00:00");

			$data['stime']  = array(array('gt', $stime), array('lt', $etime));
			$data['actual'] = array(array('gt', 0));

			$m = D('Account');
			$arr = $m->relation(true)->where($data)->select();

			$tmoney  = $m->where($data)->sum('total');
			$amoney  = $m->where($data)->sum('actual');
			$pnumber = $m->where($data)->sum('pnumber');
			$vnumber = $m->where($data)->sum('vnumber');
			$y2n     = $m->where($data)->sum('y2s');
			$y4n     = $m->where($data)->sum('y4s');

			$data['payment'] = array(array('eq', 1));
			$xpay    = $m->where($data)->sum('actual');
			if(!$xpay) $xpay = 0;
			$data['payment'] = array(array('eq', 2));
			$wpay    = $m->where($data)->sum('actual');
			if(!$wpay) $wpay = 0;
			$data['payment'] = array(array('eq', 3));
			$zpay    = $m->where($data)->sum('actual');
			if(!$zpay) $zpay = 0;

			if($arr) {
				$this->assign('xpay', $xpay);
				$this->assign('wpay', $wpay);
				$this->assign('zpay', $zpay);
				$this->assign('y2n', $y2n);
				$this->assign('y4n', $y4n);
				$this->assign('tmoney', $tmoney);
				$this->assign('amoney', $amoney);
				$this->assign('pnumber', $pnumber);
				$this->assign('vnumber', $vnumber);
				$this->assign('accountList', $arr);
			}else{
				$this->assign('accountList', "0");
			}
			$this->display();
		}
		public function addRemark() {
			$id = $_GET['id'];
			$content = $_GET['content'];
			$m = D('Account');
			$data['remark'] = $content;
			$c = $m->where('id='.$id)->save($data);
			if($c) {
				echo 1;
			}else{
				echo 0;
			}
		}
		public function getVnumber() {
			$id = $_GET['id'];
			$m = D('Account');
			$arr = $m->field('vnumber')->where('id='.$id)->find();
			$this->ajaxReturn($arr);
		}
		public function test() {
			
		}
	}
?>