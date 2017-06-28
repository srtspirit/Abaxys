<script>

var A_LocalAgular = new A_LocalAgularFn()

function A_LocalAgularFn()
{
	
}

A_LocalAgularFn.prototype.A_controler = function($scope,$http,$routeParams)
{

	 A_Scope.setProcess($scope);
	 $scope.ABunloadExe["vin_lshe"] = "dbMain";
	 
	 A_LocalAgular[$scope.opts.Session]($scope,$http,$routeParams);
	
}
A_LocalAgularFn.prototype.VIN_LSHE = function($scope,$http,$routeParams) 
{
	
	$scope.kPress = function (ce,obj,tbl,dir)	
	{
		$scope.ABlstAlias(ce,obj,tbl,"vin_lshe")
	}

   $scope.VIN_LSHE_ITMID = "";
	$scope.kPress('VIN_LSHE_ITMID','VIN_LSHE_ITMID','vin_lshe',0);
	
	$scope.vin_itemSupportTbl = function()
	{
	   //$scope.VIN_ITEM_ITMID = "";
		//$scope.ABlst('VIN_ITEM_ITMID','VIN_ITEM_ITMID','vin_item',0);
	}
	
	 A_Scope.callBack = "$scope.vin_itemSupportTbl();";
	 $scope.ABchkMain();
	
}
A_LocalAgularFn.prototype.VIN_LOTCT = function($scope,$http,$routeParams) 
{
	$scope.errno = 0;
	$scope.error = "";
	$scope.utype = $scope.opts.updType;
	
	if (!$scope.opts.idVIN_LSHE)
	{
		A_LocalAgular.setOpts($scope,"idVIN_LSHE");

	}
	
	$scope.setitemcode = function(result) {
		
		console.log(result);
			for (i=0;i<result.length;i++) {
			$('#itemcode')
         .append($("<option></option>")
         .attr("value",result[i].idVIN_ITEM)
         .text(result[i].VIN_ITEM_ITMID)); 
		}
		 $( "#itemcode" ).combobox();
	}
	      $( "#itemcode" ).combobox();
			var obj = new Object();
			obj["VIN_ITEM_LOTCT"] = 1;
			A_Scope.callBack = "$scope.setitemcode(data['posts'].result);";
			$scope.ABchkMain(obj,"vin_item");
				
	$scope.kPress = function(ce,obj,tbl,dir)
	 {
		if(tbl!="vin_item") {
			$scope.ABlst(ce,obj,tbl,dir);
		}
	}
	
	$scope.vin_itemSupportTbl = function()
	{
		$scope.idVIN_ITEM = $scope.VIN_LSHE_ITMID;
		$scope.ABlst('idVIN_ITEM','idVIN_ITEM','vin_item',0);
		$scope.idVGB_SUPP = $scope.VIN_LSHE_BPART;
		$scope.ABlst('idVGB_SUPP','idVGB_SUPP','vgb_supp',0);
	}
	
	$scope.ABinitTbl('vin_lshe','idVIN_LSHE');
	$scope.ABupdChkObj('idVIN_LSHE', $scope.opts.idVIN_LSHE,true);
	
	A_Scope.callBack = "$scope.vin_itemSupportTbl();";
	$scope.ABchkMain();
	
	$('#ab-back').attr("href","#VIN_ITEMS/VIN_LSHE/Process:VIN_ITEMS,Session:VIN_LSHE,tblName:vin_lshe");
	
	var availableTags = [
    "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
    "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
    "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
    "PHP", "Python", "Ruby", "Scala", "Scheme"
  ];
  
  $(".autocomplete").autocomplete({
    source: availableTags
  });
}

$(document).ready(function () {
	 $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
});
</script>


