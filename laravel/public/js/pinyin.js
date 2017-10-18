var province = [
    {id: '1', pinyin: 'BeiJing', name: '北京'},
    {id: '2', pinyin: 'ShangHai', name: '上海'},
    {id: '3', pinyin: 'TianJin', name: '天津'},
    {id: '4', pinyin: 'ChongQing', name: '重庆'},
    {id: '5', pinyin: 'XiangGang', name: '香港'},
    {id: '6', pinyin: 'AoMen', name: '澳门'},
    {id: '7', pinyin: 'AnHui', name: '安徽'},
    {id: '8', pinyin: 'FuJian', name: '福建'},
    {id: '9', pinyin: 'GuangDong', name: '广东'},
    {id: '10', pinyin: 'GuangXi', name: '广西'},
    {id: '11', pinyin: 'GuiZhou', name: '贵州'},
    {id: '12', pinyin: 'GanSu', name: '甘肃'},
    {id: '13', pinyin: 'HaiNan', name: '海南'},
    {id: '14', pinyin: 'HeBei', name: '河北'},
    {id: '15', pinyin: 'HeNan', name: '河南'},
    {id: '16', pinyin: 'HeiLongJiang', name: '黑龙江'},
    {id: '17', pinyin: 'HuBei', name: '湖北'},
    {id: '18', pinyin: 'HuNan', name: '湖南'},
    {id: '19', pinyin: 'JiLin', name: '吉林'},
    {id: '20', pinyin: 'JiangSu', name: '江苏'},
    {id: '21', pinyin: 'JiangXi', name: '江西'},
    {id: '22', pinyin: 'LiaoNing', name: '辽宁'},
    {id: '23', pinyin: 'NeiMengGu', name: '内蒙古'},
    {id: '24', pinyin: 'NingXia', name: '宁夏'},
    {id: '25', pinyin: 'QingHai', name: '青海'},
    {id: '26', pinyin: 'ShanXi', name: '陕西'},
    {id: '27', pinyin: 'ShanXi', name: '山西'},
    {id: '28', pinyin: 'ShanDong', name: '山东'},
    {id: '29', pinyin: 'SiChuan', name: '四川'},
    {id: '30', pinyin: 'TaiWan', name: '台湾'},
    {id: '31', pinyin: 'XiZang', name: '西藏'},
    {id: '32', pinyin: 'XinJiang', name: '新疆'},
    {id: '33', pinyin: 'YunNan', name: '云南'},
    {id: '34', pinyin: 'ZheJiang', name: '浙江'},
]

var city = [
    {
        pid: '7', city: [
        {pinyin: "AnQing", name: "安庆"},
        {pinyin: "BoZhou", name: "亳州"},
        {pinyin: "BangBu", name: "蚌埠"},
        {pinyin: "ChiZhou", name: "池州"},
        {pinyin: "ChaoHu", name: "巢湖"},
        {pinyin: "ChuZhou", name: "滁州"},
        {pinyin: "FuYang", name: "阜阳"},
        {pinyin: "HeFei", name: "合肥"},
        {pinyin: "HuaiNan", name: "淮南"},
        {pinyin: "HuaiBei", name: "淮北"},
        {pinyin: "HuangShan", name: "黄山"},
        {pinyin: "LiuAn", name: "六安"},
        {pinyin: "MaAnShan", name: "马鞍山"},
        {pinyin: "SuZhou", name: "宿州"},
        {pinyin: "TongLing", name: "铜陵"},
        {pinyin: "WuHu", name: "芜湖"},
        {pinyin: "XuanCheng", name: "宣城"}
    ]
    },
    {
        pid: '8', city: [
        {pinyin: "FuZhou", name: "福州"},
        {pinyin: "LongYan", name: "龙岩"},
        {pinyin: "NanPing", name: "南平"},
        {pinyin: "NingDe", name: "宁德"},
        {pinyin: "PuTian", name: "莆田"},
        {pinyin: "QuanZhou", name: "泉州"},
        {pinyin: "SanXing", name: "三明"},
        {pinyin: "XiaMen", name: "厦门"},
        {pinyin: "ZhangZhou", name: "漳州"}
    ]
    },
    {
        pid: '9', city: [
        {pinyin: "ChaoZhou", name: "潮州"},
        {pinyin: "DongGuan", name: "东莞"},
        {pinyin: "FoShan", name: "佛山"},
        {pinyin: "GuangZhou", name: "广州"},
        {pinyin: "HeYuan", name: "河源"},
        {pinyin: "HuiZhou", name: "惠州"},
        {pinyin: "JiangMen", name: "江门"},
        {pinyin: "JieYang", name: "揭阳"},
        {pinyin: "MeiZhou", name: "梅州"},
        {pinyin: "MaoMing", name: "茂名"},
        {pinyin: "QingYuan", name: "清远"},
        {pinyin: "ShenZhen", name: "深圳"},
        {pinyin: "ShanTou", name: "汕头"},
        {pinyin: "ShaoGuan", name: "韶关"},
        {pinyin: "ShanWei", name: "汕尾"},
        {pinyin: "YunFu", name: "云浮"},
        {pinyin: "YangJiang", name: "阳江"},
        {pinyin: "ZhuHai", name: "珠海"},
        {pinyin: "ZhongShan", name: "中山"},
        {pinyin: "ZhaoQing", name: "肇庆"},
        {pinyin: "ZhanXiang", name: "湛江"}
    ]
    },
    {
        pid: '10', city: [
        {pinyin: "BeiHai", name: "北海"},
        {pinyin: "BaiSe", name: "百色"},
        {pinyin: "ChongZuo", name: "崇左"},
        {pinyin: "FangChengGang", name: "防城港"},
        {pinyin: "GuiLi", name: "桂林"},
        {pinyin: "GuiGang", name: "贵港"},
        {pinyin: "HeZhou", name: "贺州"},
        {pinyin: "HeChi", name: "河池"},
        {pinyin: "LiuZhou", name: "柳州"},
        {pinyin: "LaiBin", name: "来宾"},
        {pinyin: "NanNing", name: "南宁"},
        {pinyin: "QinZhou", name: "钦州"},
        {pinyin: "WuZhou", name: "梧州"},
        {pinyin: "YuLin", name: "玉林"}
    ]},
    {
        pid: '11', city: [
        {pinyin: "AnShun", name: "安顺"},
        {pinyin: "GuiYang", name: "贵阳"},
        {pinyin: "LiuPanShui", name: "六盘水"},
        {pinyin: "ZunYi", name: "遵义"}
    ]
    },
    {
        pid: '12', city: [
        {pinyin: "BaiYin", name: "白银"},
        {pinyin: "JinChang", name: "金昌"},
        {pinyin: "JiaYuGuan", name: "嘉峪关"},
        {pinyin: "JiuQuan", name: "酒泉"},
        {pinyin: "LanZhou", name: "兰州"},
        {pinyin: "QingYang", name: "庆阳"},
        {pinyin: "TianShui", name: "天水"},
        {pinyin: "WuWei", name: "武威"},
        {pinyin: "ZhangYe", name: "张掖"}
    ]},
    {
        pid: '13', city: [
        {pinyin: "HaiKou", name: "海口"},
        {pinyin: "SanYa", name: "三亚"}
    ]},
    {
        pid: '14', city: [
        {"pinyin":"BaoDing","name":"保定"},
        {"pinyin":"ChengDe","name":"承德"},
        {"pinyin":"CangZhou","name":"沧州"},
        {"pinyin":"HanDan","name":"邯郸"},
        {"pinyin":"HengShui","name":"衡水"},
        {"pinyin":"LangFang","name":"廊坊"},
        {"pinyin":"QinHuangDao","name":"秦皇岛"},
        {"pinyin":"ShiJiaZhuang","name":"石家庄"},
        {"pinyin":"TangShan","name":"唐山"},
        {"pinyin":"XingTai","name":"邢台"},
        {"pinyin":"ZhangJiaKou","name":"张家口"},
    ]},
    {
        pid: '15', city: [
        {"pinyin":"AnYang","name":"安阳"},
         {"pinyin":"JiaoZuo","name":"焦作"},
        {"pinyin":"KaiFeng","name":"开封"},
         {"pinyin":"LuoYang","name":"洛阳"},
         {"pinyin":"HeBi","name":"鹤壁"},
         {"pinyin":"LuoHe","name":"漯河"},
         {"pinyin":"NanYang","name":"南阳"},
         {"pinyin":"PingDingShan","name":"平顶山"},
         {"pinyin":"PuYang","name":"濮阳"},
         {"pinyin":"SanMenXia","name":"三门峡"},
         {"pinyin":"SHangQiu","name":"商丘"},
         {"pinyin":"XinXiang","name":"新乡"},
         {"pinyin":"XuChang","name":"许昌"},
         {"pinyin":"XinYang","name":"信阳"},
         {"pinyin":"ZhengZhou","name":"郑州"},
         {"pinyin":"ZhouKou","name":"周口"},
         {"pinyin":"ZhuMaDian","name":"驻马店"},
    ]},
    {
        pid: '16', city: [
        {"pinyin":"DaQing","name":"大庆"},
        {"pinyin":"HaErBin","name":"哈尔滨"},
        {"pinyin":"HeGang","name":"鹤岗"},
        {"pinyin":"HeiHe","name":"黑河"},
        {"pinyin":"JiXi","name":"鸡西"},
        {"pinyin":"JiaMuSi","name":"佳木斯"},
        {"pinyin":"MuDanJiang","name":"牡丹江"},
        {"pinyin":"QiQiHaEr","name":"齐齐哈尔"},
        {"pinyin":"QiTaiHe","name":"七台河"},
        {"pinyin":"SuiHua","name":"绥化"},
        {"pinyin":"ShuangYaShan","name":"双鸭山"},
        {"pinyin":"YiChun","name":"伊春"},
    ]},
    {
        pid: '17', city: [
        {"pinyin":"E'Zhou","name":"鄂州"},
        {"pinyin":"HuangShi","name":"黄石"},
        {"pinyin":"HuangGang","name":"黄冈"},
        {"pinyin":"JingZhou","name":"荆州"},
        {"pinyin":"JingMen","name":"荆门"},
        {"pinyin":"ShiYan","name":"十堰"},
        {"pinyin":"WuHan","name":"武汉"},
        {"pinyin":"XiangYang","name":"襄阳"},
        {"pinyin":"XiaoGan","name":"孝感"},
        {"pinyin":"XianNing","name":"咸宁"},
        {"pinyin":"YiChang","name":"宜昌"},
    ]},
    {
        pid: '18', city: [
        {"pinyin":"ChangSha","name":"长沙"},
        {"pinyin":"ChangDe","name":"常德"},
        {"pinyin":"ChenZhou","name":"郴州"},
        {"pinyin":"HengYang","name":"衡阳"},
        {"pinyin":"HuaiHua","name":"怀化"},
        {"pinyin":"LouDi","name":"娄底"},
        {"pinyin":"ShaoYang","name":"邵阳"},
        {"pinyin":"xiangTan","name":"湘潭"},
        {"pinyin":"YueYang","name":"岳阳"},
        {"pinyin":"YiYang","name":"益阳"},
        {"pinyin":"YongZhou","name":"永州"},
        {"pinyin":"ZhuZhou","name":"株洲"},
        {"pinyin":"ZhangJiaJie","name":"张家界"},
    ]},
    {
        pid: '19', city: [
        {"pinyin":"BaiShan","name":"白山"},
        {"pinyin":"BaiCheng","name":"白城"},
        {"pinyin":"ChangChun","name":"长春"},
        {"pinyin":"JiLin","name":"吉林"},
        {"pinyin":"LiaoYuan","name":"辽源"},
        {"pinyin":"SiPing","name":"四平"},
        {"pinyin":"SongYuan","name":"松原"},
        {"pinyin":"TongHua","name":"通化"},
    ]},
    {
        pid: '20', city: [
        {"pinyin":"ChangZhou","name":"常州"},
        {"pinyin":"HuaiAn","name":"淮安"},
        {"pinyin":"LianYunGang","name":"连云港"},
        {"pinyin":"NanJing","name":"南京"},
        {"pinyin":"NanTong","name":"南通"},
        {"pinyin":"SuZhou","name":"苏州"},
        {"pinyin":"SuQian","name":"宿迁"},
        {"pinyin":"TaiZhou","name":"泰州"},
        {"pinyin":"WuXi","name":"无锡"},
        {"pinyin":"XuZhou","name":"徐州"},
        {"pinyin":"YanCheng","name":"盐城"},
        {"pinyin":"YangZhou","name":"扬州"},
        {"pinyin":"ZhenJiang","name":"镇江"},
    ]},
    {
        pid: '21', city: [
        {"pinyin":"FuZhou","name":"抚州"},
        {"pinyin":"GanZhou","name":"赣州"},
        {"pinyin":"JingDeZhen","name":"景德镇"},
        {"pinyin":"JiuJiang","name":"九江"},
        {"pinyin":"JiAn","name":"吉安"},
        {"pinyin":"NanChang","name":"南昌"},
        {"pinyin":"PingXiang","name":"萍乡"},
        {"pinyin":"ShangRao","name":"上饶"},
        {"pinyin":"XinYu","name":"新余"},
        {"pinyin":"YingTan","name":"鹰潭"},
        {"pinyin":"YiChun","name":"宜春"},
    ]},
    {
        pid: '22', city: [
        {"pinyin":"AnShan","name":"鞍山"},
        {"pinyin":"BenXi","name":"本溪"},
        {"pinyin":"ChaoYang","name":"朝阳"},
        {"pinyin":"DaLian","name":"大连"}, {"pinyin":"DanDong","name":"丹东"},
        {"pinyin":"FuShun","name":"抚顺"},
        {"pinyin":"FuXin","name":"阜新"},
        {"pinyin":"HuLuDao","name":"葫芦岛"},
        {"pinyin":"JinZhou","name":"锦州"},
        {"pinyin":"LiaoYang","name":"辽阳"}, {"pinyin":"PanJin","name":"盘锦"},
        {"pinyin":"ShenYang","name":"沈阳"},
        {"pinyin":"TieLing","name":"铁岭"},
        {"pinyin":"YingKou","name":"营口"},
    ]},
    {
        pid: '23', city: [
        {"pinyin":"BaoTou","name":"包头"},
        {"pinyin":"ChiFeng","name":"赤峰"},
        {"pinyin":"E'ErDuoSi","name":"鄂尔多斯"},
        {"pinyin":"HuHeHaoTe","name":"呼和浩特"},
        {"pinyin":"TongLiao","name":"通辽"},
        {"pinyin":"WuHai","name":"乌海"},
    ]},
    {
        pid: '24', city: [
        {"pinyin":"GuYuan","name":"固原"},
        {"pinyin":"WuZhong","name":"吴忠"},
        {"pinyin":"YingChuan","name":"银川"},
    ]},
    {
        pid: '25', city: [
        {"pinyin":"XiNing","name":"西宁"},
    ]},
    {
        pid: '26', city: [
        {"pinyin":"AnKang","name":"安康"},
        {"pinyin":"BaoJi","name":"宝鸡"},
        {"pinyin":"HanZhong","name":"汉中"},
        {"pinyin":"ShangLuo","name":"商洛"},
        {"pinyin":"TongChuan","name":"铜川"},
        {"pinyin":"WeiNan","name":"渭南"}, {"pinyin":"Xi'An","name":"西安"},
        {"pinyin":"YaNan","name":"延安"},
        {"pinyin":"XianYang","name":"咸阳"},
        {"pinyin":"YuLin","name":"榆林"},
    ]},
    {
        pid: '27', city: [
        {"pinyin":"ChangZhi","name":"长治"},
        {"pinyin":"DaTong","name":"大同"},
        {"pinyin":"JinCheng","name":"晋城"},
        {"pinyin":"LinFen","name":"临汾"},
        {"pinyin":"ShuoZhou","name":"朔州"},
        {"pinyin":"TaiYuan","name":"太原"},
        {"pinyin":"XinZhou","name":"忻州"},
        {"pinyin":"YangQuan","name":"阳泉"},
        {"pinyin":"YunCheng","name":"运城"},
    ]},
    {
        pid: '28', city: [
        {"pinyin":"BinZhou","name":"滨州"},
        {"pinyin":"DongYing","name":"东营"},
        {"pinyin":"DeZhou","name":"德州"},
        {"pinyin":"HeZe","name":"菏泽"},
        {"pinyin":"JiNan","name":"济南"},
        {"pinyin":"JiNing","name":"济宁"},
        {"pinyin":"LaiWu","name":"莱芜"},
        {"pinyin":"LinYi","name":"临沂"},
        {"pinyin":"LiaoCheng","name":"聊城"},
        {"pinyin":"QingDao","name":"青岛"},
        {"pinyin":"RiZhao","name":"日照"},
        {"pinyin":"TaiAn","name":"泰安"},
        {"pinyin":"WeiFang","name":"潍坊"},
        {"pinyin":"WeiHai","name":"威海"},
        {"pinyin":"YanTai","name":"烟台"},
        {"pinyin":"ZiBo","name":"淄博"},
        {"pinyin":"ZaoZhuang","name":"枣庄"},
    ]},
    {
        pid: '29', city: [
        {"pinyin":"BaZhong","name":"巴中"},
        {"pinyin":"ChengDu","name":"成都"},
        {"pinyin":"DeYang","name":"德阳"},
        {"pinyin":"DaZhou","name":"达州"},
        {"pinyin":"GuangYuan","name":"广元"},
        {"pinyin":"GuangAn","name":"广安"},
        {"pinyin":"LuZhou","name":"泸州"},
        {"pinyin":"LeShan","name":"乐山"},
        {"pinyin":"MianYang","name":"绵阳"},
        {"pinyin":"MeiShan","name":"眉山"},
        {"pinyin":"NeiJiang","name":"内江"},
        {"pinyin":"NanChong","name":"南充"},
        {"pinyin":"PanZhiHua","name":"攀枝花"},
        {"pinyin":"SuiNing","name":"遂宁"},
        {"pinyin":"YaAn","name":"雅安"},
        {"pinyin":"YiBin","name":"宜宾"},
        {"pinyin":"ZiGong","name":"自贡"},
        {"pinyin":"Ziyang","name":"资阳"},
    ]},
    {
        pid: '30', city: [
        {"pinyin":"GaoXiong","name":"高雄"},
        {"pinyin":"JiLong","name":"基隆"},
        {"pinyin":"JiaYi","name":"嘉义"},
        {"pinyin":"TaiBei","name":"台北"},
        {"pinyin":"TaiZhong","name":"台中"},
        {"pinyin":"XinZhu","name":"新竹"},
    ]},
    {
        pid: '31', city: [
        {"pinyin":"LaSa","name":"拉萨"},
    ]},
    {
        pid: '32', city: [
        {"pinyin":"KeLaMaYi","name":"克拉玛依"},
        {"pinyin":"WuLuMuQi","name":"乌鲁木齐"},
    ]},
    {
        pid: '33', city: [
        {"pinyin":"BaoShan","name":"保山"},
        {"pinyin":"KunMing","name":"昆明"},
        {"pinyin":"YuXi","name":"玉溪"},
        {"pinyin":"ZhaoTong","name":"昭通"},
    ]},
    {
        pid: '34', city: [
        {"pinyin":"HangZhou","name":"杭州"},
        {"pinyin":"HuZhou","name":"湖州"},
        {"pinyin":"JiaXing","name":"嘉兴"},
        {"pinyin":"JinHua","name":"金华"},
        {"pinyin":"LiShui","name":"丽水"},
        {"pinyin":"NingBo","name":"宁波"},
        {"pinyin":"QuZhou","name":"衢州"},
        {"pinyin":"ShaoXing","name":"绍兴"},
        {"pinyin":"TaiZhou","name":"台州"},
        {"pinyin":"WenZhou","name":"温州"},
        {"pinyin":"ZhouShan","name":"舟山"},
    ]}
]

var get_city = function (province, city) {
    province = province || "";
    city = city || "";

    for (var i in province){
        if(province[i].pinyin == province){
            
        }
    }
}