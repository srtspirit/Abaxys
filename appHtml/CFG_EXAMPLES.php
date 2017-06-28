<div class="hidden">
<?php require_once "../appCscript/CFG_EXAMPLES.php"; ?>
</div>

<div id="mainForm" ab-main="cfg_users" style="margin:0px;">
	<div class="row"  >
		<div class="col-sm-6">
			<table class="table table-striped" >
			<tr>
				<td colspan=2>
				
					<input type="button" value="1" ng-click="setName01();" />
					<input type="button" value="2" ng-click="setName02();" />
					<input type="button" value="SetList 10" ng-click="setList(10);" />
					<input type="button" value="SetList 5" ng-click="setList(5);" />
					<input type="button" value="DbFunction" ng-click="dbFctn();" />
					
				<!-- {{message}} is $scope.message -->
				 </td>
			</tr>
			<tr>
		
				<td>
					<label class="btn-md" >Id Code</label>
				</td>
				
				<td>	
					<!-- ng-model="CFG_USERS_CODE" is $scope.CFG_USERS_CODE -->	
					<input type="text"   size=20 ng-model="CFG_USERS_CODE" value="" />  Type in new value
				</td>
				
			</tr>	
			<tr>
		
				<td>
					<label class="btn-md" > Designation</label>
				</td>
				
				<td>	
					<!-- ng-model="CFG_USERS_DESIGNATION" is $scope.CFG_USERS_DESIGNATION -->	
					<input type="text"   size=20 ng-model="CFG_USERS_DESIGNATION" value="" /> Type in new value
				</td>
				
			</tr>	
						<!-- ng-repeat = $scope['recSet'] -->
						<!-- will be refreshed every time $scope['recSet'] changes -->
			<tr>
				<td colspan=2>
					<div style="border:solid;border-width:1px;">
					<table class="table table-striped" >
						<tr>
							<td><label>COL 1</lable></td>
							<td><label>COL 2</lable></td>
							<td><label>COL 3</lable></td>
							<td><label>COL 4</lable></td>
							<td><label>Index</lable></td>
							<td><label>First</lable></td>
							<td><label>Last</lable></td>
						</tr>	
					
					<tr  role="presentation" ng-repeat="x in recSet" >
						<!--
						
						$index - $last - $first are Angular variables
						$index - is the row number of the ng_repeat  
						$last is true if last row 
						$first is true if row = 0 or first row
						Note how I can use Angular to control element appearance  style="color:{{$last?'red':'black'}}" 
						This can be done with any $scope object
						
						-->
						<td style="color:{{$last?'red':'black'}}" >{{x.col01}}</td>
						<td>{{x.col02}}</td>
						<td style="color:{{$first?'red':'black'}}">{{x.col03}}</td>
						<td>{{x.col04}}</td>
						<td>{{$index}}</td>
						<td>{{$first}}</td>
						<td>{{$last}}</td>
					
					</tr>
					</table>
					</div>
				</td>
			</tr>
			</table>
		</div>
		<div class="col-sm-6">
			<table class="table table-striped" >
			<tr>
				<td>
					POST: {{postMessage}}
				</td>
				
			</tr>	
			<tr>
		
				<td>	
					MESS: {{message}} 
				</td>
				
			</tr>	
			<tr>
		
				<td>			
					USER: {{CFG_USERS_CODE}} 
				</td>
				
			</tr>	
			<tr>
		
				<td>					
					Name: {{CFG_USERS_DESIGNATION}}
				</td>
				
			</tr>	
			
			<tr>
				<td>
					<div>
					<table class="table table-striped" >
						<tr>
							<td><label>ID</label></td>
							<td><label>CODE</label></td>
							<td><label>DESIGNATION</label></td>
							<td><label>DFLTLEVEL</label></td>
							<td><label>DFLTGROUP</label></td>
						</tr>
						<tr role="presentation" ng-repeat="y in CFG_USERS" >
							<td>{{y.CFG_USERS_ID}}</td>
							<td>{{y.CFG_USERS_CODE}}</td>
							<td>{{y.CFG_USERS_DESIGNATION}}</td>
							<td>{{y.CFG_USERS_DFLTLEVEL}}</td>
							<td>{{y.CFG_USERS_DFLTGROUP}}</td>
						</tr>
					</table?

					</div>
				</td>
			</tr>		
		</div>	
	</div>
</div>

