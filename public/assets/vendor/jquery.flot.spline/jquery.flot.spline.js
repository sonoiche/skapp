!function(f){"use strict";function d(i,e,s,t,n,l,o){var a=Math.pow,c=Math.sqrt,r=c(a(s-i,2)+a(t-e,2)),a=o*r/(r+c(a(n-s,2)+a(l-t,2))),o=o-a;return[s+a*(i-n),t+a*(e-l),s-o*(i-n),t-o*(e-l)]}var x=[];function g(i,e,s,t){(void 0===e||"bezier"!==e&&"quadratic"!==e)&&(e="quadratic"),e+="CurveTo",0==x.length?x.push([s[0],s[1],t.concat(s.slice(2)),e]):"quadraticCurveTo"==e&&2==s.length?(t=t.slice(0,2).concat(s),x.push([s[0],s[1],t,e])):x.push([s[2],s[3],t.concat(s.slice(2)),e])}function e(i,e,s){if(!0===s.splines.show){var t,n,l,o=[],a=s.splines.tension||.5,c=s.datapoints.points,r=s.datapoints.pointsize,p=i.getPlotOffset(),h=c.length,u=[];if(x=[],h/r<4)f.extend(s.lines,s.splines);else{for(t=0;t<h;t+=r)n=c[t],l=c[t+1],null==n||n<s.xaxis.min||n>s.xaxis.max||l<s.yaxis.min||l>s.yaxis.max||u.push(s.xaxis.p2c(n)+p.left,s.yaxis.p2c(l)+p.top);for(h=u.length,t=0;t<h-2;t+=2)o=o.concat(d.apply(this,u.slice(t,t+6).concat([a])));for(e.save(),e.strokeStyle=s.color,e.lineWidth=s.splines.lineWidth,g(0,"quadratic",u.slice(0,4),o.slice(0,2)),t=2;t<h-3;t+=2)g(0,"bezier",u.slice(t,t+4),o.slice(2*t-2,2*t+2));g(0,"quadratic",u.slice(h-2,h),[o[2*h-10],o[2*h-9],u[h-4],u[h-3]]),function(i,e,s,t,n){(n=f.color.parse(n)).a="number"==typeof t?t:.3,n.normalize(),n=n.toString(),e.beginPath(),e.moveTo(i[0][0],i[0][1]);for(var l=i.length,o=0;o<l;o++)e[i[o][3]].apply(e,i[o][2]);e.stroke(),e.lineWidth=0,e.lineTo(i[l-1][0],s),e.lineTo(i[0][0],s),e.closePath(),!1!==t&&(e.fillStyle=n,e.fill())}(x,e,i.height()+10,s.splines.fill,s.color),e.restore()}}}f.plot.plugins.push({init:function(i){i.hooks.drawSeries.push(e)},options:{series:{splines:{show:!1,lineWidth:2,tension:.5,fill:!1}}},name:"spline",version:"0.8.2"})}(jQuery);