<!DOCTYPE HTML>
<head>

    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
<!--    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css">-->

    <!--        <script  src="http://huahcoding.com/js/jquery-1.8.2.min.js"></script>-->


    <script  src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script rel="stylesheet" type="text/css" href="assets/bootstrap/js/bootstrap.min.js"></script>


    <link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet">

<!--    <script  src="http://getbootstrap.com/assets/js/jquery.js"></script>-->
    <script  src="http://getbootstrap.com/dist/js/bootstrap.js"></script>


<!--    <link href="http://static.scripting.com/github/bootstrap2/css/bootstrap.css" rel="stylesheet">-->
<!--    <script src="http://static.scripting.com/github/bootstrap2/js/jquery.js"></script>-->
<!--    <script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-transition.js"></script>-->
<!--    <script src="http://static.scripting.com/github/bootstrap2/js/bootstrap-modal.js"></script>-->



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script type="text/javascript" src="js/libs/board.js"></script>


<!--    <script type="text/javascript" src="http://huahcoding.com/js/third/jquery.timeago.js"></script>-->

<!--    <script rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>-->

</head>
<body ng-app="PolyglotApp" >
<table class="table table-bordered" ng-controller="BoardViewCtrl">
    <theader>
        <tr>
            <td>
                <button
                    type="button"
                    data-toggle="modal"
                   href="#NewTopicModal"
                   class="btn btn-link" >
                    [+] Topic
                </button>
                <button
                    type="button"
                    data-toggle="modal"
                    href="#NewLangModal"
                    class="btn btn-link" >
                    [+] Lang
                </button>
<!--                [+] Topic / [+] Lang-->
                <div
                    class="modal fade" id="NewTopicModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Add Topic</h4>
                            </div>
                            <div class="modal-body">
                                <label>Topic Name</label>
                                <input type="text" ng-model="newTopicName"/>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-default">Close</a>
                                <a href="#"data-dismiss="modal" class="btn btn-primary" ng-click="addTopic()">Add Topic</a>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </td>
            <td ng-repeat="lang in langs">
                {{ lang.name }}
            </td>
        </tr>
    </theader>

    <link href="http://huahcoding.com/styles/prettify.css" type="text/css" rel="stylesheet" />
    <script src="http://huahcoding.com/js/prettify.js"></script>
    <!-- // <script src="assets/js/google-code-prettify/prettify.js"></script> -->
<!--    <link href="http://huahcoding.com/styles/sunburst.css" type="text/css" rel="stylesheet" />-->

    <tr ng-repeat="topic in topics">
        <td >
            {{ topic['name'] }}
            <a class="close" href="#" ng-click="deleteTopic(topic.topic_id, $index)">&times;</a>
        </td>
        <td ng-repeat="lang in langs">
<!--            <code topicid={{ topic.topic_id }} langid={{ code.lang_id }}></code>-->
            <div ng-dblclick='edit(topic.topic_id+"-"+lang.lang_id)'>
                <pre class="prettyprint" ng-hide='assoc_codes[topic.topic_id+"-"+lang.lang_id].editing'>{{ assoc_codes[topic.topic_id+"-"+lang.lang_id].code }}</pre >
                <textarea ng-model='assoc_codes[topic.topic_id+"-"+lang.lang_id].code'
                          ng-show='assoc_codes[topic.topic_id+"-"+lang.lang_id].editing'>

                          </textarea>
                <button ng-show='assoc_codes[topic.topic_id+"-"+lang.lang_id].editing'
                        class="btn btn-default btn-mini"
                        ng-click="save(topic.topic_id, lang.lang_id)">
                    save</button>
                <button ng-show='assoc_codes[topic.topic_id+"-"+lang.lang_id].editing'
                        class="btn btn-default btn-mini"
                        ng-click='assoc_codes[topic.topic_id+"-"+lang.lang_id].editing=false'>
                    x</button>
            </div>
        </td>
    </tr>

</table>


<!-- Modal -->
<div ng-controller="BoardViewCtrl"></div>

<div class="modal fade" id="NewLangModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Language</h4>
            </div>
            <div class="modal-body">
                <label>Topic Name</label>
                <input type="text" />
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default">Close</a>
                <a href="#" class="btn btn-primary" >Add Language</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    jQuery(document).ready(function() {
        prettyPrint();
    })

    $(document).ready(function() {
        $('#windowTitleDialog').bind('show', function () {
            document.getElementById ("xlInput").value = document.title;
        });
    });
    function closeDialog () {
        $('#windowTitleDialog').modal('hide');
    };
    function okClicked () {
        document.title = document.getElementById ("xlInput").value;
        closeDialog ();
    };
    function doit(){
        console.log($('#myModal'));
        console.log($('#myModalx'));
        $('#myModal').modal('show');
    }
</script>

</body>
