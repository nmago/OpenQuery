setInterval(updater,5000);

		/***********Base strings************************/

			ss = ['секунду','секунды','секунд'];
			mm = ['минуту','минуты','минут'];
			hh = ['час','часа','часов'];
			dd = ['вчера','сегодня','только что'];
			in_= ' в '; //в
			last = 'назад';
			WeekDays = {
                1:"в понедельник",
                2:"во вторник",
                3:"в среду",
                4:"в четверг",
                5:"в пятницу",
                6:"в субботу",
                7:"в воскресенье"
            };
			Month = {
				0:"января",
                1:"февраля",
                2:"марта",
                3:"апреля",
                4:"мая",
                5:"июня",
                6:"июля",
                7:"августа",
                8:"сентября",
                9:"октября",
                10:"ноября",
                11:"декабря"
            };
			//updater();

		/***********Base strings************************/

		/*****************End base strings*******************/
		window.onload = function(){updater()};
			function updater(){
				var u = document.getElementsByClassName('need_refresh');
				for(i=0;i<u.length;i++){
					u[i].innerHTML = gettime(parseInt(u[i].getAttribute('data'))*1000);
				}
			}
			function gettime(time){
				var a = new Date(time);
				var b = new Date();
				var shift = b - a;
				if (shift < 0) return 'Дата не наступила';
				var rettime = '0';
				//
				seconds = Math.round(shift/1000);
				rettime = seconds+' '+skl(seconds,ss);
				if (seconds <= 3) return '<span style="color:grey; font-size:14px;">'+dd[2]+'</span>';
				if(seconds > 59){
					var minutes = pround(seconds/60);
					seconds = seconds - (minutes*60);
					rettime = minutes+' '+skl(minutes,mm);
					if (minutes == 1) rettime = mm[0];
				}
				if(minutes > 59){
					var hours = pround(minutes/60);
					minutes = minutes - (hours*60);
					rettime = hours+' '+skl(hours,hh);
					if (hours == 1) rettime = hh[0];
				}
				rettime+=' '+last;
				if(hours > 12){
					var today = b.getDate();
					var dateday = a.getDate();
					var h = a.getHours();
					var m = a.getMinutes();
					var weekday = a.getDay();
					var mon = a.getMonth();
					var y = a.getFullYear();
					if(h<10) h='0'+h.toString();
					if(m<10) m='0'+m.toString();
					if((hours<24) && (dateday == today))
						rettime = dd[1]+' '+h+':'+m;
					if((hours<=48) && (dateday+1 == today))
						rettime = dd[0]+' '+h+':'+m;
					if ((hours<168) && (hours >= 48))
						rettime = WeekDays[weekday]+' '+h+':'+m;
					if ((hours >= 168) && (y == b.getFullYear()))
						rettime = dateday+' '+Month[mon]+' '+h+':'+m;
					if ((hours >= 168) && (y < b.getFullYear()))
						rettime = dateday+' '+Month[mon]+' '+y+in_+h+':'+m;
				}

				return '<span style="color:grey; font-size:14px;">'+rettime+'</span>';
			}
			function pround(n){
				var t = Math.round(n);
				if(t>n) t--;
				return t;
			}

			function skl(m,a){ //a['секунда','секунды','секунд']
				while(m>99){m = m % 100;};
				if(m>20) m = m % 10;
				if(m==1) return a[0];
				if ((m>1) && (m<5)) return a[1];
				if ((m==0) || ((m>4) && (m<21))) return a[2];
			}