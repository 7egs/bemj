<?php 
/**
 * 用户商品表
 * 廖海峰
 * 2017.8.28-
 */
namespace Home\Model;
use Think\Model;
class UserGoodsModel extends Model{
    protected $_validate = array(
        array('gid','require','商品条形码不能为空'),
        array('gid','/^\d+$/','商品条形码只能是数字'),
        array('gname','require','商品名字不能为空'),
        array('gsale','require','商品售价不能为空'),
        array('gbid','require','商品竞价不能为空'),
        array('unit','require','商品单位不能为空'),
        array('guige','require','商品规格不能为空'),
        array('quality','require','商品保质期不能为空'),
        array('production','require','商品生产日期不能为空'),
        array('fenlei_id','require','商品分类不能为空'),
        array('supplier_id','require','会员供应商不能为空'),
    );
    //查询数据库处理
    public function checkgoods($goodid)
    {
        $map['gid']=$goodid;
        $map['boss_classify']=$_SESSION['boss_classify'];     
        //判断本地数据库是否存在，如果为空，则在总的从数据库调用
        if($this->where($map)->find()=='')
        {
              return false;
        }else
        {
            if($_SESSION['goods'][$goodid]['gid']==$goodid)
            {
                $_SESSION['goods'][$goodid]['num']+=1;
            }else
            {
                $_SESSION['goods'][$goodid] = $this->where($map)->find();
                $_SESSION['goods'][$goodid]['num'] = 1;
            }
        }
        $_SESSION['goods'][$goodid]['total'] =
        $_SESSION['goods'][$goodid]['num'] * $_SESSION['goods'][$goodid]['gsale'];
        return $_SESSION['goods'];
    }
    //显示其他信息
    public function othergoods()
    {
        foreach ($_SESSION['goods'] as $k => $v)
        {
            $goods['total'] += $v['total'];
            $goods['num'] += $v['num'];
        }
        if($_SESSION['memberdiscount']){
            $goods['total']=$goods['total']*$_SESSION['memberdiscount'];
        }else{
            $goods['total']=$goods['total'];
        }
        $_SESSION['formlisttotal']=$goods['total'];
        $goods['type']=count($_SESSION['goods']);
        $goods['membername']=$_SESSION['membername'];
        $goods['membermoney']=$_SESSION['membermoney'];
        return $goods;
    } 
    //商品入库存入数据库
    public function goodsstorehouse1($temp)
    {
        $map['gid']=$temp['goodsid'];
        $map['boss_classify']=$_SESSION['boss_classify'];
        $data=$this->where($map)->find();
        $data1['gid']=$temp['goodsid'];
        $data1['gname']=$temp['goodsname'];
        $data1['gsale']=$temp['goodssale'];
        $data1['gbid']=$temp['goodsbid'];
        $data1['unit']=$temp['goodsunit'];
        $data1['guige']=$temp['goodsguige'];
        $data1['quality']=$temp['goodsquality'];
        $data1['production']=$temp['goodsproduction'];
        $data1['fenlei_id']=$temp['goodsfenlei'];
        $data1['supplier_id']=$temp['goodssupplier'];
        $data1['gnum']=$temp['goodsnum']+$data['gnum'];
        $data1['boss_classify']=$_SESSION['boss_classify'];
        $data4['date']=time();
        $data4['gid']=$temp['goodsid'];
        $data4['gbid']=$temp['goodsbid'];
        $data4['gnum']=$temp['goodsnum'];
        $data4['boss_classify']=$_SESSION['boss_classify'];
        $data4['username']=$_SESSION['username'];
        if($data)
        {
            //save
            $data2=$this->where($map)->save($data1);
            $log=M('warehousing_log');
            $list1=$log->add($data4);
            if($data2){
                return "1";
            }else{
                return "2";
            }
        }else
        {
            //商品不存在，请添加商品add
            $log=M('warehousing_log');
            if (!$this->create($data1)){ // 创建数据对象
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                return $this->getError();
            }else{
                // 验证通过 写入新增数据
                $data1['state']='0';
                $data3=$this->add($data1);
                $log->add($data4);
            }
            if($data3){
                return $data3;
            }else{
                return '添加失败';
            }

        }
    }
    //商品添加存入数据库
    public function goodsstorehouse2($temp)
    {
        $map['gid']=$temp['goodsid'];
        $map['boss_classify']=$_SESSION['boss_classify'];
        $data=$this->where($map)->find();
        $data1['gid']=$temp['goodsid'];
        $data1['gname']=$temp['goodsname'];
        $data1['gsale']=$temp['goodssale'];
        $data1['gbid']=$temp['goodsbid'];
        $data1['unit']=$temp['goodsunit'];
        $data1['guige']=$temp['goodsguige'];
        $data1['quality']=$temp['goodsquality'];
        $data1['production']=$temp['goodsproduction'];
        $data1['fenlei_id']=$temp['goodsfenlei'];
        $data1['supplier_id']=$temp['goodssupplier'];
        $data1['state']=$temp['goodsstate'];
        $data1['integration']=$temp['goodsintegration'];
        $data1['user_member']=$temp['goodsuser_member'];
        $data1['boss_classify']=$_SESSION['boss_classify'];
        $data1['sale']=$temp['goodsissale'];
        $data1['correlation_gid']=$temp['goodscorrelation_gid'];
        $data1['correlation_num']=$temp['goodscorrelation_num'];
        if($data){
            //save
            $data2=$this->where($map)->save($data1);
            if($data2){
                    return "1";
                }else{
                    return "2";
                }
        }else{
            //add
            if (!$this->create($data1)){ // 创建数据对象
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                return $this->getError();
            }else{
                // 验证通过 写入新增数据
                $data3=$this->add($data1);
            }
            if($data3){
                return $data3;
            }else{
                return '添加失败';
            }
        }
    }
    //商品管理显示页面
    public function goodsmessageshow()
    {
       //$data=$this->join('supplier ON user_goods.supplier_id=supplier.id')->join('goods_fenlei ON user_goods.fenlei_id=goods_fenlei.id')->select();
        $map['boss_classify']=$_SESSION['boss_classify'];
        $list=$this->where($map)->select();
        foreach ($list as $key=>$value){
            $fenlei['id']=$value['fenlei_id'];
            $listold1=M('goods_fenlei')->where($fenlei)->select();
            $supplier['id']=$value['supplier_id'];
            $listold2=M('supplier')->where($supplier)->select();
            $data[$key]['gid']=$value['gid'];
            $data[$key]['gname']=$value['gname'];
            $data[$key]['fenlei_id']=$value['fenlei_id'];
            $data[$key]['supplier_id']=$value['supplier_id'];
            $data[$key]['gsale']=$value['gsale'];
            $data[$key]['gbid']=$value['gbid'];
            $data[$key]['gnum']=$value['gnum'];
            $data[$key]['quality']=$value['quality'];
            $data[$key]['state']=$value['state'];
            $data[$key]['guige']=$value['guige'];
            $data[$key]['unit']=$value['unit'];
            $data[$key]['production']=$value['production'];
            $data[$key]['supplier_name']=$listold2[0]['supplier_name'];
            $data[$key]['fenlei_name']=$listold1[0]['fenlei_name'];    
        }    
       if($data){
       return $data;    
       }else{
       return false;
       }
    }
    //商品修改方法
    public function updategoods($gid,$temp)
    {
        $map['gid']=$gid;
        $map['boss_classify']=$_SESSION['boss_classify'];
        $data['gname']=$temp['gname'];
        $data['gsale']=$temp['gsale'];
        $data['gbid']=$temp['gbid'];
        $data['gnum']=$temp['gnum'];
        $data['state']=$temp['state'];
        $data['guige']=$temp['guige'];
        $data['unit']=$temp['unit'];
        $data['quality']=$temp['quality'];
        $data['production']=$temp['production'];
        $data['fenlei_id']=$temp['goodsfenlei'];
        $data['supplier_id']=$temp['goodssupplier'];
        $data['integration']=$temp['integration'];
        $data['user_menber']=$temp['user_member'];
        $data['sale']=$temp['sale'];
        $data['correlation_gid']=$temp['correlation_gid'];
        $data['correlation_num']=$temp['correlation_num'];
        $list=$this->where($map)->save($data);
        if($list){
            return $list;
        } else{
            echo "<script>alert('商品未进行任何修改');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
    }
}
?>