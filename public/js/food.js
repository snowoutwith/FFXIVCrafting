var food={init:function(){food.grid_events()},grid_events:function(){$(".food-grid td.reveal").click(function(){var t=$(this),a=t.data("a"),e=t.data("b"),i=t.closest(".food-selection"),d=i.find(".items-table"),s=d.find("tbody");d.find("caption h2").html(t.data("originalTitle"));if(!t.hasClass("active")){$(".food-grid td.reveal").removeClass("active"),t.addClass("active"),d.removeClass("hidden"),$("tr",s).addClass("hidden").each(function(){var t=$(this),i=t.data("stats").split("|");(a==i[0]&&e==i[1]||a==i[1]&&e==i[0])&&t.removeClass("hidden")}),$(".items-table th, .items-table td").removeClass("hidden"),$(".items-table th:nth-child(4), .items-table td:nth-child(4)").not(".cart").addClass("hidden"),a==e&&$(".items-table th:nth-child(3), .items-table td:nth-child(3)").not(".cart").addClass("hidden");var l=[],o="",r="";$("tr:visible",s).each(function(){var t=$(this),a=$("td:first-child a:last-child",t).text(),e=$("td:nth-child(2)",t),i=$("td:nth-child(3)",t);0==i.length&&(i=e),""==o&&(o=e.data("statName")),""==r&&(r=i.data("statName"));var d="hq"==t.data("quality")?" (HQ)":"";l.push({name:a+d,color:"rgb(255, 64, 64)",data:[[e.data("amount"),i.data("amount")]]})}),$(".highchart",i).removeClass("hidden"),$(".highchart",i).highcharts({chart:{type:"scatter",zoomType:"xy",backgroundColor:"#262626"},labels:{style:{color:"#d6d4cf"}},title:{text:t.data("originalTitle"),style:{color:"#d6d4cf"}},xAxis:{title:{enabled:!0,text:o},startOnTick:!0,endOnTick:!0,showLastLabel:!0},yAxis:{title:{text:r}},legend:{enabled:!1},plotOptions:{scatter:{marker:{radius:5,states:{hover:{enabled:!0,lineColor:"rgb(100,100,100)"}},symbol:"circle"},states:{hover:{marker:{enabled:!1}}},tooltip:{headerFormat:"<b>{series.name}</b><br>",pointFormat:"{point.x} "+o+", {point.y} "+r}}},series:l})}}),$(".items-table .sort").click(function(){var t=$(this),a=t.closest("table"),e=a.find("tbody");$("tr:visible",e);a.find(".sort .glyphicon").addClass("glyphicon-sort").removeClass("glyphicon-sort-by-attributes").removeClass("glyphicon-sort-by-attributes-alt");var i="asc"==t.data("order")?"desc":"asc";t.data("order",i),t.find(".glyphicon").removeClass("glyphicon-sort").addClass("glyphicon-sort-by-attributes"+("desc"==i?"-alt":""));var d=e.children("tr:visible").sort(function(a,e){var a=parseInt($(a).find("td:nth-child("+t.data("column")+")").data("amount")),e=parseInt($(e).find("td:nth-child("+t.data("column")+")").data("amount"));return a<e?-1:a>e?1:0});"desc"==i&&(d=Array.prototype.reverse.call(d)),e.append(d)})},sort_using_data:function(t,a,e){}};$(food.init);