<?php
class UtilUser
{
	private static $firstNames = '赵\钱\孙\李\周\吴\郑\王\冯\陈\褚\卫\蒋\沈\韩\杨\朱\秦\尤\许\何\吕\施\张\孔\曹\严\华\金\魏\陶\姜\戚\谢\邹\喻\柏\水\窦\章\云\苏\潘\葛\奚\范\彭\郎\鲁\韦\昌\马\苗\凤\花\方\俞\任\袁\柳\酆\鲍\史\唐\费\廉\岑\薛\雷\贺\倪\汤\滕\殷\罗\毕\郝\邬\安\常\乐\于\时\傅\皮\卞\齐\康\伍\余\元\卜\顾\孟\平\黄\和\穆\萧\尹\姚\邵\湛\汪\祁\毛\禹\狄\米\贝\明\臧\计\伏\成\戴\谈\宋\茅\庞\熊\纪\舒\屈\项\祝\董\梁\杜\阮\蓝\闵\席\季\麻\强\贾\路\娄\危\江\童\颜\郭\梅\盛\林\刁\锺\徐\邱\骆\高\夏\蔡\田\樊\胡\凌\霍\虞\万\支\柯\昝\管\卢\莫\经\房\裘\缪\干\解\应\宗\丁\宣\贲\邓\郁\单\杭\洪\包\诸\左\石\崔\吉\钮\龚\程\嵇\邢\滑\裴\陆\荣\翁\荀\羊\於\惠\甄\麴\家\封\芮\羿\储\靳\汲\邴\糜\松\井\段\富\巫\乌\焦\巴\弓\牧\隗\山\谷\车\侯\宓\蓬\全\郗\班\仰\秋\仲\伊\宫\宁\仇\栾\暴\甘\钭\历\戎\祖\武\符\刘\景\詹\束\龙\叶\幸\司\韶\郜\黎\蓟\溥\印\宿\白\怀\蒲\邰\从\鄂\索\咸\籍\赖\卓\蔺\屠\蒙\池\乔\阳\郁\胥\能\苍\双\闻\莘\党\翟\谭\贡\劳\逄\姬\申\扶\堵\冉\宰\郦\雍\却\璩\桑\桂\濮\牛\寿\通\边\扈\燕\冀\僪\浦\尚\农\温\别\庄\晏\柴\瞿\阎\充\慕\连\茹\习\宦\艾\鱼\容\向\古\易\慎\戈\廖\庾\终\暨\居\衡\步\都\耿\满\弘\匡\国\文\寇\广\禄\阙\东\欧\殳\沃\利\蔚\越\夔\隆\师\巩\厍\聂\晁\勾\敖\融\冷\訾\辛\阚\那\简\饶\空\曾\毋\沙\乜\养\鞠\须\丰\巢\关\蒯\相\查\后\荆\红\游\竺\权\逮\盍\益\桓\公';

	private static $lastNames = '梦琪\忆柳\之桃\慕青\问兰\尔岚\元香\初夏\沛菡\傲珊\曼文\乐菱\痴珊\恨玉\惜文\香寒\新柔\语蓉\海安\夜蓉\涵柏\水桃\醉蓝\春儿\语琴\从彤\傲晴\语兰\又菱\碧彤\元霜\怜梦\紫寒\妙彤\曼易\南莲\紫翠\雨寒\易烟\如萱\若南\寻真\晓亦\向珊\慕灵\以蕊\寻雁\映易\雪柳\孤岚\笑霜\海云\凝天\沛珊\寒云\冰旋\宛儿\绿真\盼儿\晓霜\碧凡\夏菡\曼香\若烟\半梦\雅绿\冰蓝\灵槐\平安\书翠\翠风\香巧\代云\梦曼\幼翠\友巧\听寒\梦柏\醉易\访旋\亦玉\凌萱\访卉\怀亦\笑蓝\春翠\靖柏\夜蕾\冰夏\梦松\书雪\乐枫\念薇\靖雁\寻春\恨山\从寒\忆香\觅波\静曼\凡旋\以亦\念露\芷蕾\千兰\新波\代真\新蕾\雁玉\冷卉\紫山\千琴\恨天\傲芙\盼山\怀蝶\冰兰\山柏\翠萱\恨松\问旋\从南\白易\问筠\如霜\半芹\丹珍\冰彤\亦寒\寒雁\怜云\寻文\乐丹\翠柔\谷山\之瑶\冰露\尔珍\谷雪\乐萱\涵菡\海莲\傲蕾\青槐\冬儿\易梦\惜雪\宛海\之柔\夏青\亦瑶\妙菡\春竹\痴梦\紫蓝\晓巧\幻柏\元风\冰枫\访蕊\南春\芷蕊\凡蕾\凡柔\安蕾\天荷\含玉\书兰\雅琴\书瑶\春雁\从安\夏槐\念芹\怀萍\代曼\幻珊\谷丝\秋翠\白晴\海露\代荷\含玉\书蕾\听白\访琴\灵雁\秋春\雪青\乐瑶\含烟\涵双\平蝶\雅蕊\傲之\灵薇\绿春\含蕾\从梦\从蓉\初丹。听兰\听蓉\语芙\夏彤\凌瑶\忆翠\幻灵\怜菡\紫南\依珊\妙竹\访烟\怜蕾\映寒\友绿\冰萍\惜霜\凌香\芷蕾\雁卉\迎梦\元柏\代萱\紫真\千青\凌寒\紫安\寒安\怀蕊\秋荷\涵雁\以山\凡梅\盼曼\翠彤\谷冬\新巧\冷安\千萍\ 凝阳\访风\天亦\平绿\盼香\觅风\小霜\雪萍\半雪\山柳\谷雪\靖易\白薇\梦菡\飞绿\如波\又晴\友易\香菱\冬亦\问雁\妙春\海冬\半安\平春\幼柏\秋灵\凝芙\念烟\白山\从灵\尔芙\迎蓉\念寒\翠绿\翠芙\靖儿\妙柏\千凝\小珍\天巧。妙旋\雪枫\夏菡\元绿\痴灵\绮琴\雨双\听枫\觅荷\凡之\晓凡\雅彤\香薇\孤风\从安\绮彤\之玉\雨珍\幻丝\代梅\香波\青亦\元菱\海瑶\飞槐\听露\梦岚\幻竹\新冬\盼翠\谷云\忆霜\水瑶\慕晴\秋双\雨真\觅珍\丹雪\从阳\元枫\痴香\思天\如松\妙晴\谷秋\妙松\晓夏\香柏\巧绿\宛筠\碧琴\盼兰\小夏\安容\青曼\千儿\香春\寻双\涵瑶\冷梅\秋柔\思菱\醉波\醉柳\以寒\迎夏\向雪\香莲\以丹\依凝\如柏\雁菱\凝竹\宛白\初柔\南蕾\书萱\梦槐\香芹\南琴\绿海\沛儿\晓瑶\听春\凝蝶\紫雪\念双\念真\曼寒\凡霜\飞雪\雪兰\雅霜\从蓉\冷雪\靖巧\翠丝\觅翠\凡白\乐蓉\迎波\丹烟\梦旋\书双\念桃\夜天\海桃\青香\恨风\安筠\觅柔\初南\秋蝶\千易\安露\诗蕊\山雁\友菱\香露\晓兰\白卉\语山\冷珍\秋翠\夏柳\如之\忆南\书易\翠桃\寄瑶\如曼\问柳\香梅\幻桃\又菡\春绿\醉蝶\亦绿\诗珊\雪环\蕴涵\淑颖\瑾萱\钰彤\璟雯\慕涵\思蕊\思淼\芮婷\芸熙\婧瑶\沁舒\睿雪 乐珍\寒荷\觅双\白桃\安卉\迎曼\盼雁\乐松\涵山\恨寒\问枫\以柳\含海\秋春\翠曼\忆梅\涵柳\梦香\海蓝\晓曼\代珊\春冬\恨 荷\忆丹\静芙\绮兰\梦安\紫丝\千雁\凝珍\香萱\梦容\冷雁\飞柏\天真\翠琴\寄真\秋荷\代珊\初雪\雅柏\怜容\如风\南露\紫易\冰凡\海 雪\语蓉\碧玉\翠岚\语风\盼丹\痴旋\凝梦\从雪\白枫\傲云\白梅\念露\慕凝\雅柔\盼柳\半青\从霜\怀柔\怜晴\夜蓉\代双\以南\若菱\芷 文\寄春\南晴\恨之\梦寒\初翠\灵波\巧春\问夏\凌春\惜海\亦旋\沛芹\幼萱\白凝\初露\迎海\绮玉\凌香\寻芹\秋柳\尔白\映真\含雁\寒 松\友珊\寻雪\忆柏\秋柏\巧风\恨蝶\青烟\问蕊\灵阳\春枫\又儿\雪巧\丹萱\凡双\孤萍\紫菱\寻凝\傲柏\傲儿\友容\灵枫\尔丝\曼凝\若 蕊\问丝\思枫\水卉\问梅\念寒\诗双\翠霜\夜香\寒蕾\凡阳\冷玉\平彤\语薇\幻珊\紫夏\凌波\芷蝶\丹南\之双\凡波\思雁\白莲\从菡\如 容\采柳\沛岚\惜儿\夜玉\水儿\半凡\语海\听莲\幻枫\念柏\冰珍\思山\凝蕊\天玉\问香\思萱\向梦\笑南\夏旋\之槐\元灵\以彤\采萱\巧 曼\绿兰\平蓝\问萍\绿蓉\靖柏。迎蕾\碧曼\思卉\白柏\妙菡\怜阳\雨柏\雁菡\梦之\又莲\乐荷\寒天\凝琴\书南\映天\白梦\初瑶\恨竹\平 露\含巧\慕蕊\半莲\醉卉\天菱\青雪\雅旋\巧荷\飞丹\恨云\若灵\尔云\幻天\诗兰\青梦\海菡\灵槐\忆秋\寒凝\凝芙\绮山\静白\尔蓉\尔 冬\映萱\白筠\冰双\访彤\绿柏\夏云\笑翠\晓灵\含双\盼波\以云\怜翠\雁风\之卉\平松\问儿\绿柳\如蓉\曼容\天晴\丹琴\惜天\寻琴\痴 春\依瑶\涵易\忆灵\从波\依柔\问兰\山晴\怜珊\之云\飞双\傲白\沛春\雨南\梦之\笑阳\代容\友琴\雁梅\友桃\从露\语柔\傲玉\觅夏\晓 蓝\新晴\雨莲\凝旋\绿旋\幻香\觅双\冷亦\忆雪\友卉\幻翠\靖柔\寻菱\丹翠\安阳\雅寒\惜筠\尔安\雁易\飞瑶\夏兰\沛蓝\静丹\山芙\笑 晴\新烟\笑旋\雁兰\凌翠\秋莲\书桃\傲松\语儿\映菡\初曼\听云\孤松\初夏\雅香\语雪\初珍\白安\冰薇\诗槐\冷玉\冰巧\之槐\香柳\问 春\夏寒\半香\诗筠\新梅\白曼\安波\从阳\含桃\曼卉\笑萍\碧巧\晓露\寻菡\沛白\平灵\水彤\安彤\涵易\乐巧\依风\紫南\亦丝\易蓉\紫 萍\惜萱\诗蕾\寻绿\诗双\寻云\孤丹\谷蓝\惜香\谷枫\山灵\幻丝\友梅\从云\雁丝\盼旋\幼旋\尔蓝\沛山\代丝\痴梅\觅松\冰香\依玉\冰 之\妙梦\以冬\碧春\曼青\冷菱\雪曼\安白\香桃\安春\千亦\凌蝶\又夏\南烟。靖易\沛凝\翠梅\书文\雪卉\乐儿\傲丝\安青\初蝶\寄灵\惜 寒\雨竹\冬莲\绮南\翠柏\平凡\亦玉\孤兰\秋珊\新筠\半芹\夏瑶\念文\晓丝\涵蕾\雁凡\谷兰\灵凡\凝云\曼云\丹彤\南霜\夜梦\从筠\雁 芙\语蝶\依波\晓旋\念之\盼芙\曼安\采珊\盼夏\初柳\迎天\曼安\南珍\妙芙\语柳\含莲\晓筠\夏山\尔容\采春\念梦\傲南\问薇\雨灵\凝 安\冰海\初珍\宛菡\冬卉\盼晴\冷荷\寄翠\幻梅\如凡\语梦\易梦\千柔\向露\梦玉\傲霜\依霜\灵松\诗桃\书蝶\恨真\冰蝶\山槐\以晴\友 易\梦桃\香菱\孤云\水蓉\雅容\飞烟\雁荷\代芙\醉易\夏烟\山梅\若南\恨桃\依秋\依波\香巧\紫萱\涵易\忆之\幻巧\水风\安寒\白亦\惜 玉\碧春\怜雪\听南\念蕾\梦竹\千凡\寄琴\采波\元冬\思菱\平卉\笑柳\雪卉\南蓉\谷梦\巧兰\绿蝶\飞荷\平安\孤晴\芷荷\曼冬\寻巧\寄 波\尔槐\以旋\绿蕊\初夏\依丝\怜南\千山\雨安\水风\寄柔\念巧\幼枫\凡桃\新儿\春翠\夏波\雨琴\静槐\元槐\映阳\飞薇\小凝\映寒\傲 菡\谷蕊\笑槐\飞兰\笑卉\迎荷\元冬\书竹\半烟\绮波\小之\觅露\夜雪\春柔\寒梦\尔风\白梅\雨旋\芷珊\山彤\尔柳\沛柔\灵萱\沛凝\白 容\乐蓉\映安\依云\忆香\觅波\静曼\凡旋\以亦\念露\芷蕾\千兰\新波\代真\新蕾\雁玉\冷卉\紫山\千琴\恨天\傲芙\盼山\怀蝶\冰兰\山 柏\翠萱\恨松\问旋\从南\白易\问筠\如霜\半芹\丹珍\冰彤\亦寒\寒雁\怜云\寻文\乐丹\翠柔\谷山\之瑶\冰露\尔珍\谷雪\乐萱\涵菡\海 莲\傲蕾\青槐\冬儿\易梦\惜雪\宛海\之柔\夏青\亦瑶\妙菡\春竹\痴梦\紫蓝\晓巧\幻柏\元风\冰枫\访蕊\南春\芷蕊\凡蕾\凡柔\安蕾\天 荷\含玉\书兰\雅琴\书瑶\春雁\从安\夏槐\念芹\怀萍\代曼\幻珊\谷丝\秋翠\白晴\海露\代荷\含玉\书蕾\听白\访琴\灵雁\秋春\雪青\乐 瑶\含烟\涵双\平蝶\雅蕊\傲之\灵薇\绿春\含蕾\从梦\从蓉\初丹。听兰\听蓉\语芙\夏彤\凌瑶\忆翠\幻灵\怜菡\紫南\依珊\妙竹\访烟\怜 蕾\映寒\友绿\冰萍\惜霜\凌香\芷蕾\雁卉\迎梦\元柏\代萱\紫真\千青\凌寒\紫安\\从梦\从蓉\初丹。听兰\听蓉\语芙\夏彤\凌瑶\忆翠\幻灵\怜菡\紫南\依珊\妙竹\访烟\怜蕾\映寒\友绿\冰萍\惜霜\凌香\芷蕾\雁卉\迎梦\元柏\代萱\紫真\千青\凌寒\紫安\寒安\怀蕊\秋荷\涵雁\以山\凡梅\盼曼\翠彤\谷冬\新巧\冷安\千萍\冰烟\雅阳\友绿\南松\诗云\飞风\寄灵\书芹\幼蓉\以蓝\笑寒\忆寒\秋烟\芷巧\水香\映之\醉波\幻莲\夜山\芷卉\向彤\小玉\幼南\凡梦\尔曼\念波\迎松\青寒\笑天\涵蕾\碧菡\映秋\盼烟\忆山\以寒\寒香\小凡\代亦\梦露\映波\友蕊\寄凡\怜蕾\雁枫\水绿\曼荷\笑珊\寒珊\谷南\慕儿\夏岚\友儿\小萱';

	private static $mails = '@163.com\@126.com@sina.com\@yahoo.com.cn\@yahoo.cn\@gmail.com\@sohu.com\@tom.com\@188.com\@21cn.com\@yeah.net';
	
	private function string2Array($string)
	{
		
		$result = explode('\\', $string);
		
		return $result;		
		
	}
	
	public static function getFirstName()
	{
		$result = self::string2Array(self::$firstNames);
		
		return $result[array_rand($result, 1)];
	}
	
	public static function getLastName()
	{
		$result = self::string2Array(self::$lastNames);
		
		return $result[array_rand($result, 1)];
	}	
	
	public static function getName()
	{
		return self::getFirstName().self::getLastName();
	}
	
	public static function getNamePinYin($name)
	{
		$pinyin = new PinYin();
		
		return $pinyin->words2PinYin($name, 'UTF-8');
	}
	
	public static function getEmail($name)
	{
		$result = self::string2Array(self::$mails);
		
		return $name.$result[array_rand($result, 1)];
	}
	
	public static function getGender()
	{
		$result = array(Profile::GENDER_FAMALE, Profile::GENDER_MALE, Profile::GENDER_SECRET);
		
		return $result[array_rand($result, 1)];
	}
	
}
?>