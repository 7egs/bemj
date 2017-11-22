<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
class GoodsManageController extends CommonController {
      public function index()
      {
       $this->display();
      }
      //显示商品页面
      public function goodsmanageshow()
      {
        $supplier=M('supplier');
        $map['boss_classify']=$_SESSION['boss_classify'];
        $list=$supplier->where($map)->select();
        $goods=D('user_goods');
        $list2=$goods->goodsmessageshow();        
        $fenlei=M('goods_fenlei');
        $list3=$fenlei->where($map)->select();
        $this->assign('list3',$list3);
        $this->assign('list2',$list2);
        $this->assign('list',$list);
        $this->display();
      }
      //商品供应商添加
      public function suppliershow()
      {
            if(IS_POST)
            {
                $data['supplier_name']=$_POST['suppliername'];
                $data['supplier_men']=$_POST['suppliermen'];
                $data['supplier_phone']=$_POST['supplierphone'];
                $data['addr']=$_POST['supplieraddr'];
                $data['status']=$_POST['supplierstatus'];
                $data['boss_classify']=$_SESSION['boss_classify'];
                $supplier=D('supplier');
                if (!$supplier->create($data)){ // 创建数据对象
                    // 如果创建失败 表示验证没有通过 输出错误提示信息
                    $asd = $supplier->getError();
                    $this->error($asd);
                }else{
                    // 验证通过 写入新增数据
                    $supplier->add($data);
                    $this->success('添加成功',U('goodsmanageshow'));
                }
                
            }
      }
      //商品供应商修改页面
      public function updatesuppliershow()
      {
          $id=$_GET['id'];
          $supplier=M('supplier');
          $list=$supplier->find($id);
          $this->assign('list',$list);
          $this->display();
      }
      //商品供应商修改功能
      public function updatesupplier()
      {
          $id=$_GET['id'];
          if(IS_POST)
          {
              $data['supplier_name']=$_POST['suppliername'];
              $data['supplier_men']=$_POST['suppliermen'];
              $data['supplier_phone']=$_POST['supplierphone'];
              $data['addr']=$_POST['supplieraddr'];
              $data['status']=$_POST['supplierstatus'];
              $supplier=M('supplier');
              $list=$supplier->where("id=$id")->save($data);
              if($list){
                  $this->success('商品修改成功',U('goodsmanageshow'));
              }else{
                  echo "<script>alert('商品供应商未进行任何修改');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
              }
              
          }
      }
      //删除供应商功能
      public function delsupplier()
      {
          $id=$_GET['id'];
          $supplier=M('supplier');
          $supplier->where("id=$id")->delete();
          $this->redirect('goodsmanageshow');
      }
      //商品分类
      public function addfenlei()
      {
          $data['fenlei_name']=$_POST['fenleiname'];
          $data['boss_classify']=$_SESSION['boss_classify'];
          $fenlei=D('goods_fenlei');
          if (!$fenlei->create($data))
          { // 创建数据对象
              // 如果创建失败 表示验证没有通过 输出错误提示信息
              $asd = $fenlei->getError();
              $this->error($asd);
          }else{
              // 验证通过 写入新增数据
              $fenlei->add($data);
              $this->success('添加成功',U('goodsmanageshow'));
          }
      }
      //删除商品分类
      public function delfenlei()
      {
         $id=$_GET['id'];
         $fenlei=M('goods_fenlei');
         $fenlei->where("id=$id")->delete();
         $this->redirect('goodsmanageshow');
      }
      //商品入库
      public function goodsstorehouse1()
      {
         if(IS_POST)
         {
             $usergoods=D('user_goods');
             $list=$usergoods->goodsstorehouse1(I('post.'));
             if(is_numeric($list)){
                 $this->success('添加成功',U('goodsmanageshow'));
             }else{
                 $this->error($list,U('goodsmanageshow'));
             }
         }else{
             $this->redirect('goodsmanageshow');
         }
      }
      //商品添加
      public function goodsstorehouse2()
      {
          if(IS_POST)
          {
              $usergoods=D('user_goods');
              $list=$usergoods->goodsstorehouse2(I('post.'));
              if(is_numeric($list)){
                  $this->success('添加成功',U('goodsmanageshow'));
              }else{
                  $this->error($list,U('goodsmanageshow'));
              }
          }else{
              $this->redirect('goodsmanageshow');
          }
      }
      //商品修改页面
      public function updategoodsshow()
      {
         $goodsgid=$_GET['gid'];
         $map['gid']=$goodsgid;
         $map['boss_classify']=$_SESSION['boss_classify'];
         $map2['boss_classify']=$_SESSION['boss_classify'];
         $goods=M('user_goods');
         $list=$goods->where($map)->find();
         $supplier=M('supplier');
         $list2=$supplier->where($map2)->select();
         $fenlei=M('goods_fenlei');
         $list3=$fenlei->where($map2)->select();
         $this->assign('goodsgid',$goodsgid);
         $this->assign('list',$list);
         $this->assign('list2',$list2);
         $this->assign('list3',$list3);
         $this->display();
      }
      //商品修改
      public function updategoods()
      {
          $gid=(I('get.goodsgid'));
          $goods=D('user_goods');
          $list=$goods->updategoods($gid,I('post.'));
          if($list==true){
               $this->success('修改成功',U('goodsmanageshow'));
          }
      }
      //商品删除
      public function delgoodsshow()
      {
          $map['gid']=$_GET['gid'];
          $map['boss_classify']=$_SESSION['boss_classify'];
          $goods=M('user_goods');
          $list=$goods->where($map)->delete();
          if($list){
              $this->redirect('goodsmanageshow');
          }
      }
      //ajax多页面显示 
      public function goodsmessageajax()
      {
         if(IS_POST)
         {
             $map['gid']=$_POST['goodsid1'];
             $map['boss_classify']=$_SESSION['boss_classify'];
             $goods=M('user_goods');
             $list=$goods->where($map)->find();
             if($list){
                 echo json_encode($list);
             }else{
                 return false;
             }
         }
      }     
      //商品盘点
      public function commodityinventory(){
          if(IS_POST){
          $time = I('post.');
      $time_low = I('post.');
          $time['start_time'] = strtotime($time['start_time']);
          $time['end_time'] = strtotime($time['end_time']);
          if ($time['start_time'] > $time['end_time'] || !$time['start_time']  || !$time['end_time'] ){
            echo "<script>alert('请正确输入');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
          }
          $where['boss_classify']=$_SESSION['boss_classify'];
          $catch_goods = M('user_goods')->where($where)->order('id DESC')->select();
          $catch_order = M('user_order')->where($where)->select();
          $jinjia = '0';
          $shoujia = '0';
          foreach ($catch_goods  as  $value){                    
               $catch['gid'] = $value['gid'];
               $catch['gname'] = $value['gname'];
               $catch['guige'] = $value['guige'];
               $catch['gbid'] = $value['gbid'];
               $catch['gsale'] = $value['gsale'];
               $catch['gnum_new'] = $value['gnum'];
               $where_log['gid'] = $value['gid'];
               $where_log['boss_classify']=$_SESSION['boss_classify'];
               $catch_log = M('warehousing_log')->where($where_log)->select();
               $catch['gnum'] = '0';
               $catch['snum'] = '0';
               foreach ($catch_log  as  $v){ 
                if($time['start_time']<=$v['date'] && $v['date'] <= $time['end_time'] && $time['end_time']!=$time['start_time']){
                    $catch['gnum'] = $catch['gnum'] + $v['gnum'] ;
                }else if(date('Y-m-d', $v['date'])==$time_low['start_time']){
                    $catch['gnum'] = $catch['gnum'] + $v['gnum'] ;
                }
               }
               foreach ($catch_order  as  $v){
                if($time['start_time']<=$v['date'] && $v['date'] <= $time['end_time'] && $time['end_time']!=$time['start_time']){
                     $where_order['parentid'] = $v['orderid'];
                     $where_order['gid'] = $value['gid'];
                     $catch_now = M('order_goods')->where($where_order)->select();
                     $catch['snum'] = $catch['snum'] + $catch_now['0']['num'];
                     $jinjia = $jinjia + ($catch['snum'] * $catch['gbid']);
                }else if(date('Y-m-d', $v['date'])==$time_low['start_time']){
                     $where_order['parentid'] = $v['orderid'];
                     $where_order['gid'] = $value['gid'];
                     $catch_now = M('order_goods')->where($where_order)->select();
                     $catch['snum'] = $catch['snum'] + $catch_now['0']['num'];
                     $jinjia = $jinjia + ($catch['snum'] * $catch['gbid']);
                }  
                }
                $catch['lirun'] = ( $catch['gsale'] - $catch['gbid'] ) * $catch['snum'] ;
                $catch_new[] = $catch;
          }
          foreach($catch_order  as  $value){
                if($time['start_time']<=$value['date'] && $value['date'] <= $time['end_time'] && $time['end_time']!=$time['start_time']){
                  $shoujia = $value['order_money'] + $shoujia ;
                }else if(date('Y-m-d', $value['date'])==$time_low['start_time']){
                  $shoujia = $value['order_money'] + $shoujia ;
                }             
          }
          $zonglirun = $shoujia - $jinjia;
          $this->assign('zonglirun',$zonglirun);
          $this->assign('jinjia',$jinjia);
          $this->assign('shoujia',$shoujia);
          $this->assign('catch',$catch_new);
          }
          $this->display(); 
      }
      //商品导出
      public function export()
      {
        import("Org.Yufan.Excel");
        $list = M('user_goods')->select();
        $row=array();
        $row[0]=array('序号','商品条码','商品名称','商品售价',
            '商品进价',"超市序列号","商品数量","商品销售量","商品状态","商品规格",
            "商品单位","商品保证期","商品生产日期","商品分类","商品供应商","是否积分产品",
            "是否使用余额","是否会员打折","关联商品条码","关联商品数量");
        $i=1;
        foreach($list as $v)
        {
          $row[$i]['i'] = $i;
          $row[$i]['uid'] = $v['gid'];
          $row[$i]['gname'] = $v['gname'];
          $row[$i]['gsale'] = $v['gsale'];
          $row[$i]['gbid'] = $v['gbid'];
          $row[$i]['boss_classify'] = $v['boss_classify'];
          $row[$i]['gnum'] = $v['gnum'];
          $row[$i]['snum'] = $v['snum'];
          $row[$i]['state'] = $v['state']==0?"启用":"禁用";
          $row[$i]['guige'] = $v['guige'];
          $row[$i]['unit'] = $v['unit'];
          $row[$i]['quality'] = $v['quality'];
          $row[$i]['production'] = $v['production'];
          //查询
          $rowfenlei_id['id'] = $v['fenlei_id'];
          $rowfenlei = M('goods_fenlei')->where($rowfenlei_id)->select();
          $row[$i]['fenlei_id'] = $rowfenlei['0']['fenlei_name'];
          //查询
          $supplier_id['id'] = $v['supplier_id'];
          $supplier = M('supplier')->where($supplier_id)->select();
          $row[$i]['supplier_id'] = $supplier['0']['supplier_name'];
          $row[$i]['integration'] = $v['integration']==0?"是":"否";
          $row[$i]['user_member'] = $v['user_member']==0?"是":"否";
          $row[$i]['sale'] = $v['sale']==0?"是":"否";
          $row[$i]['correlation_gid'] = $v['correlation_gid'];
          $row[$i]['correlation_num'] = $v['correlation_num'];
          $i++;
        }
        $xls = new \Excel_XML('UTF-8', false, 'datalist');
        $xls->addArray($row);
        $xls->generateXML("shangpindaochubiao");
      }
      //商品导入
      public function import()
      {
        $upload = new \Think\Upload();
        $upload->maxSize   =     3145728 ;
        $upload->exts      =     array('xlsx');
        $upload->rootPath  =      './Upload/';
        $upload->savePath  =      'excel/';
        $info   =   $upload->upload();
        if(!$info){
          $this->error("请使用百米e家专用模版导入");
        }else{
          $filename='./Upload/'.$info['excel']['savepath'].$info['excel']['savename'];
          import("Org.Yufan.ExcelReader");
          $ExcelReader=new \ExcelReader();
          $arr=$ExcelReader->reader_excel($filename);
          foreach ($arr as $key => $value)
          {
            if($arr[$key]['0']!="0"){
              $this->error('所商品序号修改为0，再提交');
            }else{
              $data['gid'] = $arr[$key]['1'];
              $data['gname'] = $arr[$key]['2'];
              $data['gsale'] = $arr[$key]['3'];
              $data['gbid'] = $arr[$key]['4'];
              $data['boss_classify'] = $arr[$key]['5'];
              $data['gnum'] = $arr[$key]['6'];
              $data['snum'] = $arr[$key]['7'];
              $data['state'] = $arr[$key]['8']=="启用"?0:1;
              $data['guige'] = $arr[$key]['9'];
              $data['unit'] = $arr[$key]['10'];
              $data['quality'] = $arr[$key]['11'];
              $data['production'] = $arr[$key]['12'];
              $map['fenlei_name']=$arr[$key]['13'];
              $map['boss_classify']=$_SESSION['boss_classify'];
              $list=M('goods_fenlei')->where($map)->find();
              if($list){
                $data['fenlei_id']=$list['id'];
              }else{
                $data['fenlei_id']="0";
              }
              $map['supplier_name']=$arr[$key]['14'];
              $map['boss_classify']=$_SESSION['boss_classify'];
              $list1=M('supplier')->where($map)->find();
              if($list1){
                $data['supplier_id']=$list1['id'];
              }else{
                $data['fenlei_id']="0";
              }
              $data['integration'] = $arr[$key]['15']=="是"?0:1;
              $data['user_member'] = $arr[$key]['16']=="是"?0:1;
              $data['sale'] = $arr[$key]['17']=="是"?0:1;
              $data['correlation_gid'] = $arr[$key]['18'];
              $data['correlation_num'] = $arr[$key]['19'];
              $map1['gid']=$data['gid'];
              $map1['boss_classify']=$_SESSION['boss_classify'];
              $list=M('user_goods')->where($map1)->find();
            $catch['gid'] = $data['gid'];
            $catch_date['gsale'] = $arr[$key]['3'];
            $catch_date['gbid'] = $arr[$key]['4'];
            $catch_date['correlation_gid'] = $arr[$key]['18'];
            $catch_date['correlation_num'] = $arr[$key]['19'];
              if(is_array($list)){
                M('user_goods')->where($map1)->save($data);
            M('user_goods')->where($catch)->save($catch_date);
              }else{
            $pass = M('user_goods')->where($catch)->find();
            //判断总库里面是否有商品
            if($pass){
            M('user_goods')->where($catch)->save($catch_date);  
            }else{
            M('user_goods')->add($catch_date);    
            }
            M('user_goods')->add($data);
            M('user_goods')->where($map1)->save($data);
              }
            }
          }
          unlink($filename);
          $this->success('导入成功');      
        }
      }
      //入库查询
      public function ruku_find(){
         $where['boss_classify'] = $_SESSION['boss_classify'];
         $catch = M('warehousing_log')->where($where)->order('id DESC')->select();
         if(IS_POST){
          $time = I('post.');
      $time_low = I('post.');
          $time['start_time'] = strtotime($time['start_time']);
          $time['end_time'] = strtotime($time['end_time']);
          if ($time['start_time'] > $time['end_time']|| !$time['start_time']  || !$time['end_time'] ){
            echo "<script>alert('请正确输入');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
          }
          foreach ($catch  as $key => $value){                    
          if($time['start_time']<=$value['date'] && $value['date']<=$time['end_time'] && $time['end_time']!=$time['start_time']){
              $where_now['gid'] = $value['gid'];
              $where_now['boss_classify'] = $_SESSION['boss_classify'];
              $tatch = M('user_goods')->where($where_now)->find();
              $value['gname'] = $tatch ['gname'];
              $value['guige'] = $tatch ['guige'];
              $value['unit'] = $tatch ['unit'];
              $value['gsale'] = $tatch ['gsale'];
              $catch_now[]  = $value;
            }else if(date('Y-m-d', $value['date'])==$time_low['start_time']){
              $where_now['gid'] = $value['gid'];
              $where_now['boss_classify'] = $_SESSION['boss_classify'];
              $tatch = M('user_goods')->where($where_now)->find();
              $value['gname'] = $tatch ['gname'];
              $value['guige'] = $tatch ['guige'];
              $value['unit'] = $tatch ['unit'];
              $value['gsale'] = $tatch ['gsale'];
              $catch_now[]  = $value; 
            }
         } 
         }else{
         $time = date('Y-m-d', time()); 
         foreach ($catch  as $key => $value) {
          if(date('Y-m-d', $value['date'])==$time){
              $where_now['gid'] = $value['gid'];
              $where_now['boss_classify'] = $_SESSION['boss_classify'];
              $tatch = M('user_goods')->where($where_now)->find();
              $value['gname'] = $tatch ['gname'];
              $value['guige'] = $tatch ['guige'];
              $value['unit'] = $tatch ['unit'];
              $value['gsale'] = $tatch ['gsale'];
              $catch_now[]  = $value;
            }
         } 
         }                 
         $this->assign('catch',$catch_now);
         $this->display(); 
      } 
       //入库信息修改
      public function ruku_save(){
        $id = $_GET['id'];
      if(IS_POST){
        $post = I('post.');
    $post_low = I('post.');
        if (!preg_match('/^[0-9]+(.[0-9]{1,3})?$/',$post['gbid'])){  
           echo "<script>alert('请不要尝试乱输入,多次乱输入将会锁死页面');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
          }
        if(!preg_match("/^\d*$/",$post['gnum'])){
           echo "<script>alert('请不要尝试乱输入,多次乱输入将会锁死页面');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
          }
        $where_id['id'] = $id;
        $catch = M('warehousing_log')->where($where_id)->find(); 
        if(floor($post_low['gnum'])!=$post_low['gnum'] || 0 > $post['gnum'] || $post['gnum']==null){
              echo "<script>alert('数量必须大于等于0');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
        }
        if(0 > $post['gbid'] || $post['gbid']==null){
              echo "<script>alert('价格必须大于等0');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";die;
        }
        $catch_log = M('warehousing_log')->where($where_id)->save($post); 
        $catch_num = $post['gnum']-$catch['gnum'];
        $where_goods['boss_classify'] = $_SESSION['boss_classify'];
        $where_goods['gid'] = $catch['gid'];     
        $catch_goods = M('user_goods')->where($where_goods)->find();
        $save_goods['gnum'] = $catch_goods['gnum']+$catch_num;  
        $save_goods['gbid'] = $post['gbid'];
        $catch_goods = M('user_goods')->where($where_goods)->save($save_goods);
        $this->success('修改库存成功',U('ruku_find'));   
      }else{
        $this->assign('id',$id);
        $this->display();          
      }
      } 

}
