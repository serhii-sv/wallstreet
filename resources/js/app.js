import Echo from 'laravel-echo';
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
if (token){
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}else{
  console.error('CSRF token not found');
}

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  // encrypted: true,auth: {
  //   headers: { "X-CSRF-Token": token },
  // },

})

{
    LineChart: {
        "tooltip": {"show": true},
        "title": {"show": true, "textStyle": {"color": "rgba(0, 0, 0 , .87)", "fontFamily": "sans-serif"}},
        "grid": {"containLabel": true, "left": "0", "bottom": "0", "right": "0"},
        "xAxis": {
            "show": true,
                "type": "category",
                "axisLine": {"lineStyle": {"color": "rgba(255, 255, 255 , .54)", "type": "dashed"}},
            "axisTick": {
                "show": true,
                    "alignWithLabel": true,
                    "lineStyle": {"show": true, "color": "rgba(0, 0, 0 , .54)", "type": "dashed"}
            },
            "axisLabel": {"show": false},
            "boundaryGap": false
        },
        "yAxis": {
            "show": false,
                "type": "value",
                "axisLine": {"lineStyle": {"color": "rgba(0, 0, 0 , .54)", "type": "dashed"}},
            "axisLabel": {"show": false},
            "splitLine": {"lineStyle": {"type": "dashed"}},
            "axisTick": {
                "show": true,
                    "lineStyle": {"show": true, "color": "rgba(0, 0, 0 , .54)", "type": "dashed"}
            }
        },
        "series": [{"type": "line", "areaStyle": {}, "smooth": true}],
            "dataset": {
            "source": [
                {
                    "month": "Jan",
                    "Unique Visit": 296,
                    "Page View": 548},
                {
                "month": "Feb",
                "Unique Visit": 1181,
                "Page View": 714
            }, {"month": "Mar", "Unique Visit": 235, "Page View": 961}, {
                "month": "Apr",
                "Unique Visit": 294,
                "Page View": 580
            }, {"month": "May", "Unique Visit": 765, "Page View": 730}, {
                "month": "Jun",
                "Unique Visit": 412,
                "Page View": 1249
            }, {"month": "Jul", "Unique Visit": 1125, "Page View": 267}, {
                "month": "Aug",
                "Unique Visit": 800,
                "Page View": 251
            }, {"month": "Sep", "Unique Visit": 948, "Page View": 1043}, {
                "month": "Oct",
                "Unique Visit": 1046,
                "Page View": 1118
            }, {"month": "Nov", "Unique Visit": 363, "Page View": 573}, {
                "month": "Dec",
                "Unique Visit": 909,
                "Page View": 283
            }]
        },
        "color": ["#000"]
    },
};
