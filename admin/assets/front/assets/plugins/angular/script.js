	var myApp = angular
					.module("myModule", [])
					.controller("myController", function ($scope)
					{
					var subject = [
					
						{ name: "C#", likes: 0, dislikes: 0 },
						{ name: "ASAP.NET", likes: 0, dislikes: 0 },
					
					];
					
					$scope.subject = subject;
					
					$scope.incrementLikes = function (technology)
					{
						technology.likes++;
					}
					
					$scope.incrementDislikes = function (technology)
					{
						technology.dislikes++;
					}
						
					});