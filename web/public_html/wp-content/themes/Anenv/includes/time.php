
<script type="text/javascript">
today=new Date();
var day; var date; var hello;
hour=new Date().getHours()
if(hour < 6)hello='  凌晨好! '
else if(hour < 8)hello=' 新的一天，新的开始! '
else if(hour < 9)hello='每一天都要有好的心情! '
else if(hour < 12)hello=' 上午您过的咋样呢？ '
else if(hour < 14)hello=' 下午您还有工作吗？ '
else if(hour < 17)hello=' 下午您累吗？ '
else if(hour < 18)hello=' 下午过的咋样呢？'
else if(hour < 19)hello=' 傍晚了， 您吃晚饭了吗？'
else if(hour < 22)hello='  现在您在做什么呢？'
else {hello='夜深了。 亲，该休息了!'}
var webUrl = webUrl;
document.write(' '+hello);
</script>
<script type="text/javascript">
　today=new Date(); var tdate,tday, x,year; var x = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五","星期六");
　　var MSIE=navigator.userAgent.indexOf("MSIE");
　　if(MSIE != -1)
　　 year =(today.getFullYear());
　　else
　　 year = (today.getYear()+1900);
　　tdate= year+ "年" + (today.getMonth() + 1 ) + "月" + today.getDate() + "日" + " " + x[today.getDay()];
　　document.write(tdate); 
//-->
</script>