

<div class="row  collps-on  ">
	<div class="col-sm-6" style="padding: 5px 0 0 20px;">
		<textarea ng-model="xxx.VIT_ISSDET_TEXT_N"  rows=1 cols=60 ></textarea>
		<input class="hidden" ng-model="xxx.idVIT_ISSUE" ng-init"idVIT_ISSDET=0" />

	</div>
	<div class="col-sm-6" id="local-sysOpt"  style="padding: 5px 0px;">
			<span	ng-mouseover="prepDetail(xxx.idVIT_ISSUE,xxx.VIT_ISSDET_TEXT_N);"  
			class="btn-link ab-pointer text-primary" 
			ng-if="xxx.VIT_ISSDET_TEXT_N.length>0"
			ng-click="issdetABupd('CREATE',xxx.idVIT_ISSUE,xxx.VIT_ISSDET_TEXT);"  type="button" value="Create" > 
				<span class="text-primary" ab-label="">
				Add
				</span> 
				<span class="glyphicon glyphicon-floppy-disk">
				</span>
			</span>
	</div>

</div>

