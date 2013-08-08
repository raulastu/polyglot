var app = angular.module('PolyglotApp',[]);

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}
app.filter('mapData',function($scope){
    return function(text){
        return $scope.assoc_codes[text].code;
    }
});

app.controller('BoardViewCtrl', ['$scope','$http', function($scope, $http){
    var key = getURLParameter('key');
    $http({
        method:"get",
        url:'/boarddata/getall',
        params:{key:key}
    }).success(function(data){
        var langs = $scope.langs= data.langs;
        var topics = $scope.topics= data.topics;
        var codes = $scope.codes= data.codes;
        $scope.assoc_codes = new Object();
        console.log(data.topics);
        console.log(data.langs);
        console.log(data.codes);
        for(var j = 0; j<$scope.codes.length;j++){
//            console.log(i);
            var topicid = $scope.codes[j].topic_id;
            var langid = $scope.codes[j].lang_id;
            var mapid = topicid+"-"+langid;
            console.log(mapid);
            $scope.assoc_codes[mapid] = new Object();
            $scope.assoc_codes[mapid].code = $scope.codes[j].code;
            $scope.assoc_codes[mapid].editing=false;
        }
//        for(var i=0;i<topics.length;i++){
//            for(var j=0;j<langs.length;j++){
//                var mapId = topics[i].topic_id+"-"+langs[j].lang_id;
//                if($scope.assoc_codes[mapId]==undefined){
//                    $scope.assoc_codes[mapId]={};
////                    $scope.assoc_codes[mapId].enabled=true;
//                }
//            }
//        }

        console.log($scope.assoc_codes);
    });
    $scope.edit = function(code){
        console.log(code);
//        if()
        if($scope.assoc_codes[code]==undefined){
            $scope.assoc_codes[code]={};
        }
        $scope.assoc_codes[code].editing=true;
    }
    $scope.save = function(topicId, langId){
        $scope.assoc_codes[topicId+"-"+langId].editing=false;
        $http({
            method:"post",
            url:'/boarddata/code',
            params:{t_id:topicId, l_id:langId, key:key},
            data: $scope.assoc_codes[topicId+"-"+langId].code
        }).success(function(data){
            console.log(data);
        });
    }
    $scope.showModal = function(){
        console.log(jQuery('#myModal'));
        jQuery('#myModal').modal({});
    }

    $scope.addTopic = function(){
        $http({
            method:"post",
            url:'/boarddata/addtopic',
            params:{name:$scope.newTopicName}
        }).success(function(data){
            console.log(data);
            $scope.topics.push({
                topic_id:data.id,
                name:$scope.newTopicName
            })
            console.log($scope.topics);
        });
//        $scope.$apply();
    }

    $scope.deleteTopic = function(id, index){
        console.log(index);

        $http({
            method:"post",
            url:'/boarddata/deltopic',
            params:{id:id,key:key}
        }).success(function(data){
            if(data==1){
                $scope.topics.splice(index,1);
            }
//            console.log($scope.topics);
       });
    }

    $scope.timeAgo=function(s){
        console.log(s);
        var split = s.split(" ");
        var date = split[0].split("-");
        var time = split[1].split(":");
        var year= date[0], month=date[1], day=date[2];
        var hours= time[0], min=time[1], sec=time[2];
        return jQuery.timeago(
            new Date(year, month-1, day, hours, min, sec, 0)
        );
    }
}]);
