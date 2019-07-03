<?php

$access_token = 'OQyobbkeIxjWwJQxsbGeXH/tUGgjeF92a1MwWk4CnQ8R8f5UOnf84SFiApseMJLsl9K4JumE/4wRNyjFmcbfR64jQIXfYaJzRNiqV968mzSpacYpGpdICwBx29tQiQmufK6dYF5wgQDhRTBIhel5GwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$_msg = $events['events'][0]['message']['text'];

$SiteMsg = substr($_msg,-7);
$SiteMRF = strtoupper($SiteMsg);
$bMsg = substr($SiteMRF,0,3);
$cMsg = substr($SiteMRF,0,4);
$dMsg = substr($SiteMRF,0,5);
$Pdata = array("CMI","CRI","LPG","LPN","MHS","NAN","PHE","PYO");
$PROVINCE = array("เชียงใหม่", "เชียงราย", "ลำปาง", "ลำพูน", "แม่ฮ่องสอน", "นาน", "แพร่", "พะเยา");
$Sitedata= "XXXxxxx";
$AMPHOE="xxxxxxxxxxxx";
$TAMBON="xxxxxxxxx";
$LATITUDE=90;
$LONGITUDE=0;
$G900="Active";
$U850="Active";
$U2100="Active";
$L2100="Active";
$L1800="Active";
$L900="Active";

$CMIL = array(array("CMI0027",	"เมืองเชียงใหม่",	"หายยา",	18.78013,	98.98756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0033",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81422,	98.9825,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0034",	"เมืองเชียงใหม่",	"สุเทพ",	18.78762,	98.97255,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0036",	"เมืองเชียงใหม่",	"สุเทพ",	18.79547,	98.97758,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0039",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.7894,	98.9877,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0040",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.73444,	98.95696,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0041",	"เมืองเชียงใหม่",	"ป่าแดด",	18.76357,	98.99277,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0042",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.77614,	98.99774,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0043",	"เมืองเชียงใหม่",	"หายยา",	18.77964,	98.99375,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0044",	"เมืองเชียงใหม่",	"หนองหอย",	18.76387,	99.00655,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0046",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.7894,	98.9968,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0047",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79534,	98.99497,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0048",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78226,	99.00189,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0049",	"เมืองเชียงใหม่",	"วัดเกต",	18.78623,	99.01476,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0050",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.78538,	99.02356,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0051",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.7684,	99.02842,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0052",	"เมืองเชียงใหม่",	"หนองป่าครั่ง",	18.79129,	99.03021,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0053",	"เมืองเชียงใหม่",	"วัดเกต",	18.80181,	99.01611,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0054",	"สันทราย",	"สันพระเนตร",	18.81089,	99.02982,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0056",	"เมืองเชียงใหม่",	"ฟ้าฮ่าม",	18.80845,	99.01009,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI0057",	"เมืองเชียงใหม่",	"ป่าตัน",	18.81569,	98.99625,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0058",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79999,	98.99847,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0059",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.802,	98.9856,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0060",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.82905,	98.97897,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0062",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79603,	98.98721,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0064",	"เมืองเชียงใหม่",	"สุเทพ",	18.80482,	98.95915,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0065",	"เมืองเชียงใหม่",	"สุเทพ",	18.79353,	98.95192,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0066",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80556,	98.96917,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0067",	"สันกำแพง",	"ต้นเปา",	18.7676,	99.0821,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0068",	"สันกำแพง",	"สันกำแพง",	18.74255,	99.11824,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0069",	"สารภี",	"ยางเนิ้ง",	18.7152,	99.0379,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0070",	"สารภี",	"สารภี",	18.6714,	99.05353,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0072",	"หางดง",	"หางดง",	18.67895,	98.92019,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0073",	"สันป่าตอง",	"ทุ่งต้อม",	18.62105,	98.8969,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0074",	"สันป่าตอง",	"บ้านกลาง",	18.56477,	98.87418,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0075",	"จอมทอง",	"ข่วงเปา",	18.4242,	98.68192,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0078",	"แม่แตง",	"ขี้เหล็ก",	19.08854,	98.93802,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI0080",	"แม่ริม",	"ริมใต้",	18.917,	98.9501,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0081",	"แม่ริม",	"ขี้เหล็ก",	19.00245,	98.94261,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI0092",	"ดอยหล่อ",	"ดอยหล่อ",	18.51306,	98.83217,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI0093",	"แม่ริม",	"แม่แรม",	18.91993,	98.91774,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI0637",	"ฮอด",	"หางดง",	18.1927,	98.6078,	"Active",	"",	"Active",	"Active",	"",	"Active",),
array("CMI1213",	"แม่ออน",	"ออนเหนือ",	18.7875,	99.2575,	"Active",	"",	"Active",	"Active",	"",	"Active",),
array("CMI1305",	"สันทราย",	"สันทรายหลวง",	18.8525,	99.0403,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1320",	"ดอยหล่อ",	"ดอยหล่อ",	18.45722,	98.76944,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1507",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81631,	98.97225,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1508",	"สารภี",	"หนองผึ้ง",	18.741,	99.01582,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1517",	"สันทราย",	"ป่าไผ่",	18.8727,	99.0517,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1518",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80586,	98.98997,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1519",	"หางดง",	"สันผักหวาน",	18.71172,	98.94166,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1537",	"เมืองเชียงใหม่",	"สุเทพ",	18.81472,	98.88223,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1540",	"สันกำแพง",	"สันกลาง",	18.77723,	99.055,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1600",	"เมืองเชียงใหม่",	"แม่เหียะ",	18.75484,	98.97203,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1601",	"เมืองเชียงใหม่",	"วัดเกต",	18.77193,	99.01565,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1602",	"เมืองเชียงใหม่",	"สุเทพ",	18.78979,	98.95479,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1604",	"แม่ริม",	"ดอนแก้ว",	18.84702,	98.97495,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1606",	"สันทราย",	"หนองจ๊อม",	18.82881,	99.02017,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1607",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.77246,	98.98624,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1608",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80361,	98.97862,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1610",	"ดอยเต่า",	"มืดกา",	17.93823,	98.70674,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1611",	"แม่แจ่ม",	"ช่างเคิ่ง",	18.49852,	98.36631,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1612",	"จอมทอง",	"สบเตี๊ยะ",	18.34687,	98.68929,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1613",	"จอมทอง",	"บ้านแปะ",	18.24718,	98.60603,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1616",	"แม่แจ่ม",	"ช่างเคิ่ง",	18.57393,	98.48233,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1618",	"แม่ออน",	"บ้านสหกรณ์",	18.82306,	99.22969,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1619",	"สันป่าตอง",	"บ้านแม",	18.6347,	98.8494,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1620",	"สารภี",	"ป่าบง",	18.74194,	99.05361,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1621",	"ดอยสะเก็ด",	"ตลาดใหญ่",	18.81,	99.1225,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1622",	"แม่แตง",	"แม่แตง",	19.14833,	98.94528,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1623",	"แม่แตง",	"ช่อแล",	19.1483,	99.01088,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1624",	"แม่แตง",	"อินทขิล",	19.18122,	98.97899,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1625",	"เชียงดาว",	"เมืองงาย",	19.45626,	98.95908,	"Active",	"",	"Active",	"Active",	"",	"Active",),
array("CMI1627",	"ฝาง",	"สันทราย",	19.87463,	99.18756,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1628",	"ฝาง",	"โป่งน้ำร้อน",	19.93297,	99.17155,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1629",	"แม่อาย",	"แม่สาว",	19.96564,	99.24483,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1630",	"แม่อาย",	"ท่าตอน",	20.053,	99.35659,	"Active",	"",	"Active",	"Active",	"",	"Active",),
array("CMI1631",	"แม่ริม",	"ห้วยทราย",	18.95777,	98.92105,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1633",	"เวียงแหง",	"เมืองแหง",	19.58168,	98.6189,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1641",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.86556,	98.98556,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1644",	"หางดง",	"หนองควาย",	18.72139,	98.92028,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1645",	"สารภี",	"ท่าวังตาล",	18.71474,	98.98782,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1646",	"ดอยสะเก็ด",	"สันปูเลย",	18.79945,	99.06139,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1647",	"หางดง",	"หนองแก๋ว",	18.655,	98.93833,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1649",	"สันป่าตอง",	"มะขุนหวาน",	18.58781,	98.91671,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1652",	"สันทราย",	"หนองแหย่ง",	18.89157,	99.09106,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1653",	"จอมทอง",	"บ้านหลวง",	18.48141,	98.66518,	"",	"Active",	"",	"",	"",	"",),
array("CMI1657",	"สันกำแพง",	"ทรายมูล",	18.73937,	99.15164,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1659",	"หางดง",	"บ้านปง",	18.80278,	98.83472,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1672",	"แม่แตง",	"สบเปิง",	19.08298,	98.85336,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1675",	"เมืองเชียงใหม่",	"สุเทพ",	18.78943,	98.96552,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1679",	"สันทราย",	"สันพระเนตร",	18.795,	99.0339,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1682",	"เมืองเชียงใหม่",	"ท่าศาลา",	18.77737,	99.04098,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1684",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.7669,	99.0017,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1688",	"สันทราย",	"หนองหาร",	18.8758,	99.01418,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1690",	"ฮอด",	"บ่อหลวง",	18.13727,	98.37219,	"Active",	"",	"",	"",	"",	"Active",),
array("CMI1691",	"แม่วาง",	"ทุ่งปี้",	18.5933,	98.7903,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1695",	"สันทราย",	"ป่าไผ่",	18.89088,	99.03439,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1696",	"หางดง",	"ขุนคง",	18.68559,	98.94725,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1709",	"สันทราย",	"หนองหาร",	18.91982,	98.99122,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1737",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81017,	98.9636,	"",	"Active",	"Active",	"Active",	"Active",	"",),
array("CMI1738",	"สันทราย",	"หนองหาร",	18.89108,	99.01117,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1739",	"เมืองเชียงใหม่",	"สุเทพ",	18.79159,	98.95812,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1740",	"เมืองเชียงใหม่",	"สุเทพ",	18.79718,	98.95173,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1741",	"เมืองเชียงใหม่",	"สุเทพ",	18.7955,	98.96418,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1742",	"เมืองเชียงใหม่",	"สุเทพ",	18.79683,	98.97327,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1760",	"เมืองเชียงใหม่",	"สุเทพ",	18.76334,	98.94676,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1762",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81166,	98.98897,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1763",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.8081,	98.98327,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1764",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.80173,	98.97536,	"",	"Active",	"",	"",	"",	"",),
array("CMI1765",	"เมืองเชียงใหม่",	"สุเทพ",	18.79996,	98.9599,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1766",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79675,	98.98102,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI1768",	"เมืองเชียงใหม่",	"ช้างคลาน",	18.78282,	98.996,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1769",	"เมืองเชียงใหม่",	"ศรีภูมิ",	18.79355,	98.9832,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1772",	"ฝาง",	"เวียง",	19.92445,	99.22082,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1773",	"เมืองเชียงใหม่",	"หนองหอย",	18.75902,	99.0175,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1775",	"จอมทอง",	"บ้านหลวง",	18.41877,	98.67248,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI1776",	"หางดง",	"หางดง",	18.6917,	98.92152,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1803",	"ฮอด",	"บ่อสลี",	18.14919,	98.24804,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1804",	"สารภี",	"หนองแฝก",	18.68775,	99.02712,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1805",	"สันกำแพง",	"แม่ปูคา",	18.77233,	99.11399,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1806",	"ดอยสะเก็ด",	"แม่โป่ง",	18.82039,	99.16785,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1810",	"สันกำแพง",	"แช่ช้าง",	18.72618,	99.1214,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1811",	"สารภี",	"ชมภู",	18.7009,	99.06885,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1815",	"พร้าว",	"แม่ปั๋ง",	19.24634,	99.18571,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1819",	"สันป่าตอง",	"ยุหว่า",	18.60028,	98.87763,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1888",	"ดอยสะเก็ด",	"สันปูเลย",	18.82688,	99.07053,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1903",	"เมืองเชียงใหม่",	"ช้างเผือก",	18.81754,	98.9574,	"Active",	"",	"Active",	"Active",	"Active",	"Active",),
array("CMI1904",	"สารภี",	"ไชยสถาน",	18.7506,	99.03582,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1912",	"แม่แตง",	"อินทขิล",	19.25063,	98.95127,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1913",	"เชียงดาว",	"ปิงโค้ง",	19.48602,	99.02701,	"Active",	"",	"",	"",	"",	"Active",),
array("CMI1914",	"เชียงดาว",	"ปิงโค้ง",	19.53011,	99.0561,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1915",	"ไชยปราการ",	"ศรีดงเย็น",	19.62819,	99.145,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1917",	"สารภี",	"ดอนแก้ว",	18.6991,	98.99871,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI1923",	"สันกำแพง",	"ต้นเปา",	18.74124,	99.0762,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1924",	"ฝาง",	"แม่คะ",	19.84225,	99.20874,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1927",	"แม่ริม",	"แม่สา",	18.88963,	98.96194,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1934",	"เมืองเชียงใหม่",	"ช้างม่อย",	18.79278,	98.99927,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1936",	"สันทราย",	"หนองจ๊อม",	18.84479,	99.02149,	"",	"",	"Active",	"Active",	"Active",	"",),
array("CMI1938",	"สันกำแพง",	"ร้องวัวแดง",	18.74276,	99.22886,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1941",	"เมืองเชียงใหม่",	"พระสิงห์",	18.7866,	98.98309,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1942",	"เมืองเชียงใหม่",	"สันผีเสื้อ",	18.83575,	98.99326,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1952",	"แม่อาย",	"สันต้นหมื้อ",	19.95878,	99.28209,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1953",	"สันทราย",	"หนองหาร",	18.91004,	99.01862,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1954",	"แม่ริม",	"ริมใต้",	18.91265,	98.9336,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1955",	"ไชยปราการ",	"ศรีดงเย็น",	19.68763,	99.1512,	"",	"",	"Active",	"Active",	"",	"",),
array("CMI1961",	"แม่ริม",	"โป่งแยง",	18.88665,	98.81801,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1968",	"ฝาง",	"แม่สูน",	19.83952,	99.1458,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1972",	"ฝาง",	"แม่งอน",	19.79677,	99.12121,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1975",	"สันทราย",	"สันพระเนตร",	18.79938,	99.04305,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1977",	"แม่แตง",	"สันป่ายาง",	19.02718,	98.87563,	"Active",	"Active",	"",	"",	"",	"Active",),
array("CMI1978",	"ฝาง",	"สันทราย",	19.89404,	99.22396,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1990",	"แม่ออน",	"ห้วยแก้ว",	18.85886,	99.35667,	"",	"Active",	"",	"",	"",	"",),
array("CMI1991",	"แม่ริม",	"ขี้เหล็ก",	19.02568,	98.92706,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1994",	"แม่ริม",	"สันโป่ง",	18.94278,	98.97148,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1995",	"แม่ออน",	"ห้วยแก้ว",	18.86247,	99.2748,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
array("CMI1996",	"สันป่าตอง",	"มะขุนหวาน",	18.56205,	98.91027,	"Active",	"Active",	"Active",	"Active",	"Active",	"Active",),
array("CMI1998",	"สันทราย",	"แม่แฝก",	19.0347,	98.96908,	"Active",	"Active",	"Active",	"Active",	"",	"Active",),
);


for($i=0;$i<8;$i++){
    if($bMsg==$Pdata[$i]){
        for($a=0;$a<157;$a++){
            if($SiteMRF==$CMIL[$a][0]){            
                $Sitedata= $CMIL[$a][0];
                $AMPHOE=$CMIL[$a][1];
                $TAMBON=$CMIL[$a][2];
                $LATITUDE=$CMIL[$a][3];
                $LONGITUDE=$CMIL[$a][4];
                $G900=$CMIL[$a][5];
                $U850=$CMIL[$a][6];
                $U2100=$CMIL[$a][7];
                $L2100=$CMIL[$a][8];
                $L1800=$CMIL[$a][9];
                $L900=$CMIL[$a][10];
                break;
            }
        }
        break;
    }
}


if (strpos($_msg,'-sitetech') !== false ){
    $text = $Sitedata.'
    G900  : '.$G900.'
    U850  : '.$U850.'
    U2100 : '.$U2100.'
    L2100 : '.$L2100.'
    L1800 : '.$L1800.'
    L900  : '.$L900;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];

}

else if (strpos($_msg,'-siteaddr') !== false ){
    $text = $Sitedata.'
    จ.'.$PROVINCE[$i].'  อ.'.$AMPHOE.'  ต.'.$TAMBON;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ]; 
}
else if (strpos($_msg,'-siteloc') !== false ){      
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type'=> 'location',
        'title'=> $Sitedata,
        'address'=> 'จ.'.$PROVINCE[$i].' อ.'.$AMPHOE.' ต.'.$TAMBON,
        'latitude'=> $LATITUDE,
        'longitude'=> $LONGITUDE
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];
}
else if (strpos($_msg,'-help') !== false ){
    $text = 'เรามีข้อมูลของจังหวัดดังนี้
    เชียงใหม่ เชียงราย ลำปาง ลำพูน แม่ฮ่องสอน นาน พะเยา และแพร่
เรียกใช้ผ่านฟังก์ชัน
    -siteaddr XXXxxxx  ใช้หาที่อยู่ไซต์
    -sitetech XXXxxxx  ใช้หาเทคโนโลยีที่มีในไซต์
    -siteloc XXXxxxx  ใช้หาโลเคชั่นไซต์';
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
            'type' => 'text',
            'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];    
}
else{
    $text = 'ไม่พบข้อมูล '.$_msg;
    $replyToken = $events['events'][0]['replyToken'];
    $messages = [
        'type' => 'text',
        'text' => $text,
    ];
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages]
    ];
}

$post = json_encode($data);
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result . "";


echo "OK";
?>
