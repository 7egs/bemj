<?php 
/**
 * 超市商品总库表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
//User是表名
class MamageGoodsModel extends Model
{
        protected $_validate = array(
            array('gbid','require','商品竞价不能为空'),
            array('gsale','require','商品售价不能为空'),
            array('gname','require','商品名称不能为空'),
            array('gid','require','商品条码不能为空'),
        );
        //查询总仓库的商品数据
        public function findgoods($goodsid)
        {
            $map['gid']=$goodsid;
            $list=$this->where($map)->find();
            if($list){
                return $list;
            }else{
                return false;
            }
            
        }     
        //更新总仓库，添加到超市仓库
        public function addgoods($temp1,$temp2)
        {
            $map['gid']=$temp1['gid'];
            $data['gbid']=$temp2['goodsbid'];
            $data['gsale']=$temp2['goodssale'];
            $data1['gbid']=$temp2['goodsbid'];
            $data1['gsale']=$temp2['goodssale'];
            $data1['gname']=$temp2['goodsname'];
            $data1['gid']=$temp1['gid'];
			$data1['gnum']="0";
            $data1['boss_classify']=$_SESSION['boss_classify'];
            $goods=D('user_goods');
            if (!$goods->create($data1)){ // 创建数据对象
                // 如果创建失败 表示验证没有通过 输出错误提示信息
//                 return $goods->getError();
              echo "<script>alert('请输入商品售价和竞价');</script>";
            }else{
                // 验证通过 写入新增数据
               $list1=$goods->add($data1);
               $this->where($map)->save($data);
               return $list1;
            }
           
        }
        //添加到总仓库，添加到超市仓库
        public function addgoods1($temp1,$temp2)
        {
            $data['gid']=$temp1['gid'];
            $data['gname']=$temp2['goodsname'];
            $data['gbid']=$temp2['goodsbid'];
            $data['gsale']=$temp2['goodssale'];
            $data1['gid']=$temp1['gid'];
            $data1['gname']=$temp2['goodsname'];
            $data1['gbid']=$temp2['goodsbid'];
            $data1['gsale']=$temp2['goodssale'];
            $data1['gnum']=0;
            $data1['boss_classify']=$_SESSION['boss_classify'];
            if (!$this->create($data)){ // 创建数据对象
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                echo "<script>alert('请输入商品名字，商品售价和商品竞价');</script>";
            }else{
                // 验证通过 写入新增数据
                $list1=M('user_goods')->add($data1);
                $list=$this->add($data);
                return $list;
            }
                
            
            
        }

}
?>