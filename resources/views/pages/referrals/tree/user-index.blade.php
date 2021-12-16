{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Список пользователей')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="basic-tabs" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="display-flex justify-content-between">
            <h4 class="card-title">
              @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User referral tree' contenteditable="true">{{ __('User referral tree') }}</editor_block>@else {{ __('User referral tree') }} @endif {{ $user->login ?? '' }}</h4>
          </div>
          <div class="row">
            <div class="col s12">
                <input type="range" id="range" min="100" max="300" value="100" step="10" list="steplist">
                <div class="row">
                <div class="plans-container" style="display: flex; flex-wrap: wrap;">
                  <table style="width:100%; height:400px;">
                    <tr>
                      <td style="vertical-align: central; text-align: center;">
                        <style>

                            .node {
                                cursor: pointer;
                            }

                            .node circle {
                                fill: #fff;
                                stroke: steelblue;
                                stroke-width: 1.5px;
                            }

                            .node text {
                                font: 10px sans-serif;
                            }

                            .link {
                                fill: none;
                                stroke: #ccc;
                                stroke-width: 1.5px;
                            }
                            ref > svg > g {
                                transform: translate(117px, 10px);
                            }
                            span.thumb {
                                top: 25px !important;
                                margin-left: 20px !important;
                            }
                        </style>
                        <ref></ref>
                        <script src="{{ asset('js/d3/d3.min.js') }}"></script>
                        {{--<iframe src="{{ route('user.tree.reftree', $user->id) }}" style="width:100%; height: 500px;border: 1px solid #ebebeb;"></iframe>--}}
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(function () {
            let __width = 900;
            let __height = 500;
            let flare = {};

            $.get('{{route('user.tree.reftree',['id'=>$user->id])}}').then( (response) => {
                flare = response;
                initTree(__width, __height);
            })

            $('#range').change(function () {
                let percentage = Number($(this).val());
                let widthScaleValue = __width - (__width * (percentage / 100) * 2);
                let heightScaleValue = __height - (__height * (percentage / 100) * 2);
                if (percentage !== 100) {
                    initTree(__width - widthScaleValue, __height - heightScaleValue)
                }  else {
                    initTree(__width, __height)
                }
            })

            function initTree(_width, _height) {
                console.log(_width, _height)
                var margin = {top: 10, right: 10, bottom: 10, left: 10},
                    width = _width - margin.right - margin.left,
                    height = _height - margin.top - margin.bottom;

                var i = 0,
                    duration = 750,
                    root;

                var tree = d3.layout.tree()
                    .size([height, width]);

                var diagonal = d3.svg.diagonal()
                    .projection(function (d) {
                        return [d.y, d.x];
                    });
                $('ref').html('')
                var svg = d3.select("ref").append("svg")
                    .attr("width", width + margin.right + margin.left)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                root = flare;
                root.x0 = height / 2;
                root.y0 = 0;

                function collapse(d) {
                    if (d.children) {
                        d._children = d.children;
                        d._children.forEach(collapse);
                        d.children = null;
                    }
                }

                /*root.children.forEach(collapse);*/
                update(root);

                d3.select(self.frameElement).style("height", "500px");

                function update(source) {

                    // Compute the new tree layout.
                    var nodes = tree.nodes(root).reverse(),
                        links = tree.links(nodes);

                    // Normalize for fixed-depth.
                    nodes.forEach(function (d) {
                        d.y = d.depth * 100;
                    });

                    // Update the nodes…
                    var node = svg.selectAll("g.node")
                        .data(nodes, function (d) {
                            return d.id || (d.id = ++i);
                        });

                    // Enter any new nodes at the parent's previous position.
                    var nodeEnter = node.enter().append("g")
                        .attr("class", "node")
                        .attr("transform", function (d) {
                            return "translate(" + source.y0 + "," + source.x0 + ")";
                        })
                        .on("click", click);

                    nodeEnter.append("circle")
                        .attr("r", 1e-6)
                        .style("fill", function (d) {
                            return d._children ? "lightsteelblue" : "#fff";
                        });

                    nodeEnter.append("text")
                        .attr("x", function (d) {
                            return d.children || d._children ? 15 : 10;
                        })
                        .attr("dy", "-1em")
                        .attr("text-anchor", function (d) {
                            return d.children || d._children ? "end" : "start";
                        })
                        .text(function (d) {
                            return d.name;
                        })
                        .style("fill-opacity", 1e-6);

                    // Transition nodes to their new position.
                    var nodeUpdate = node.transition()
                        .duration(duration)
                        .attr("transform", function (d) {
                            return "translate(" + d.y + "," + d.x + ")";
                        });

                    nodeUpdate.select("circle")
                        .attr("r", 4.5)
                        .style("fill", function (d) {
                            return d._children ? "lightsteelblue" : "#fff";
                        });

                    nodeUpdate.select("text")
                        .style("fill-opacity", 1);

                    // Transition exiting nodes to the parent's new position.
                    var nodeExit = node.exit().transition()
                        .duration(duration)
                        .attr("transform", function (d) {
                            return "translate(" + source.y + "," + source.x + ")";
                        })
                        .remove();

                    nodeExit.select("circle")
                        .attr("r", 1e-6);

                    nodeExit.select("text")
                        .style("fill-opacity", 1e-6);

                    // Update the links…
                    var link = svg.selectAll("path.link")
                        .data(links, function (d) {
                            return d.target.id;
                        });

                    // Enter any new links at the parent's previous position.
                    link.enter().insert("path", "g")
                        .attr("class", "link")
                        .attr("d", function (d) {
                            var o = {x: source.x0, y: source.y0};
                            return diagonal({source: o, target: o});
                        });

                    // Transition links to their new position.
                    link.transition()
                        .duration(duration)
                        .attr("d", diagonal);

                    // Transition exiting nodes to the parent's new position.
                    link.exit().transition()
                        .duration(duration)
                        .attr("d", function (d) {
                            var o = {x: source.x, y: source.y};
                            return diagonal({source: o, target: o});
                        })
                        .remove();

                    // Stash the old positions for transition.
                    nodes.forEach(function (d) {
                        d.x0 = d.x;
                        d.y0 = d.y;
                    });
                }

                // Toggle children on click.
                function click(d) {
                    if (d.children) {
                        d._children = d.children;
                        d.children = null;
                    } else {
                        d.children = d._children;
                        d._children = null;
                    }
                    update(d);
                }

            }
        })
    </script>
@endsection

@section('page-script')
  <script>

  </script>
@endsection
