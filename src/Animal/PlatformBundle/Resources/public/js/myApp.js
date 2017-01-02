var app=angular.module("animalApp",[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});
app.controller("animalController", function($scope,$http,$location,$sce) {

	$scope.information = "";

	$scope.supprimerAnimal=function(id){
			
		$http.get("supprimer/"+id)
		.then(function(response) {
			if(response.data == "true"){
				window.location.href ="lister";
			}else{
				console.log("false");
			}
		});
	};

	$scope.informationAnimal=function(id){

		$http.get("info/"+id)
		.then(function(response) {
			if(response.data){
				$scope.information = $sce.trustAsHtml(response.data);
			}else{
				console.log("false");
			}
		});
	};
});