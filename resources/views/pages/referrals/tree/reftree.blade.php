{{--<link href="/admin_assets/css/jquery.orgchart.min.css" rel="stylesheet">--}}
<link href="{{ asset('css/orgChart.css') }}" rel="stylesheet">
<style type="text/css">
    #chart-container { height:  620px; }
    .orgchart { background: transparent; }
</style>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.orgchart.min.js') }}"></script>
<script src="{{ asset('js/jquery.orgchart.min.js.map') }}"></script>

<div id="chart-container"></div>

<script type="text/javascript">
  $(function() {
    
    var datascource = {!! json_encode($children) !!};
    // ajaxURLs = {
    //   'children': '/orgchart/children/',
    //   'parent': '/orgchart/parent/',
    //   'siblings': function(nodeData) {
    //     return '/orgchart/siblings/' + nodeData.id;
    //   },
    //   'families': function(nodeData) {
    //     return '/orgchart/families/' + nodeData.id;
    //   }
    // };
    var oc = $('#chart-container').orgchart({
      'data' : datascource,
      'nodeContent': 'title',
      // 'ajaxURL': ajaxURLs,
   //   'toggleSiblingsResp': true,
      //'depth': 2,
    });
    
  });
</script>