<?php
session_start();ob_clean();

$inPost = json_decode(file_get_contents('php://input'), true);
	
	$amt = $inPost["amt"];
	
	$amtWord = new abAmountWords;
	
	echo $amtWord->evalAmt($amt);

//					0001 SETESC 63000; SETERR 63500; LET SETPGM$="WDAMT0",SETWIN$=FIN(0),SETWIN$=S
//					0001:ETWIN$(9,2)
//					0010 REM WDAMT0 - Dollar Amounts In Words N.D. Mar 17 1989
//					0100 REM 100 enter info
//					0110 SETERR 0130
//					0120 ENTER USER$[ALL],EXPO$[ALL],FIHA$[ALL],FKD$[ALL],AMT,AMT$
//					0130 SETERR 0; REM 63500
//					0500 REM main
//					0510 GOSUB 3000
//					0520 GOSUB 1000
//					0530 GOTO 9900
//					
// Evaluate AMT

class abAmountWords
{
	function evalAmt($amt)
	{
		
		// 1005 IF AMT>999999.99 THEN LET AMT$=$$; GOTO 1090
		if ($amt > 999999.99)
		{
			return "** " . $amt . " **" ;
		}
		$amtWords = $this->setAmtWords();
		// 1010 LET AMOUNT$=STR(INT(AMT):"000000")
		$amount = "000000" . intval($amt);
		$amount = substr($amount, strlen($amount)-6,6);
		
		$amtDescr = "** ";
		
		if (substr($amount,0,1)*1 > 0)
		{
			$amtDescr = $this->singles($amtDescr, substr($amount,0,1) , $amtWords);
		}
		
		$amtDescr = $this->doubles($amtDescr, substr($amount,1,2) , $amtWords);
	
		if (substr($amount,0,3)*1 > 0)
		{
			$amtDescr .= $amtWords["thousand"];
		}
	
		if (substr($amount,3,1)*1 > 0)
		{
			$amtDescr = $this->singles($amtDescr, substr($amount,3,1) , $amtWords);
		}
	
		$amtDescr = $this->doubles($amtDescr, substr($amount,4,2) , $amtWords);
	
		if ($amt != 0)
		{	
			
			$cents = "00" . round((($amt*1) - intval($amt*1)),2)*100 ;
			$cents = substr($cents, strlen($cents)-2,2);
			$amtDescr .= $amtWords["and"] . $cents . "/100";
		}
		
		$amtDescr .= " **";
		
		return $amtDescr;
		
			
	
	}
	
	// Hundreds 
	function singles($amt,$val,$amtWords)
	{
		
		
		$amt .= $amtWords["single"][$val*1] . $amtWords["hundred"];
		
		return $amt;
	}
	
	function doubles($amt,$val,$amtWords)
	{
		if ($val*1 < 20)
		{
			if ($val*1 > 0)
			{
				$amt .= $amtWords["single"][$val*1];
			}
		}
		else
		{
			$amt .= $amtWords["double"][substr($val,0,1)*1];	
			if (substr($val,1,1)*1 > 0)
			{
				$amt .= " " . $amtWords["single"][substr($val,1,1)*1*1];
			}
		}
		
		return $amt;
	}
	
	
	
	
	// 3000 REM 3000 Set Dollar Sets - DSET1 & DSET2
	function setAmtWords()
	{
		
		$single = array();
		$single[count($single)] = "";
		$single[count($single)] = "ONE";
		$single[count($single)] = "TWO";
		$single[count($single)] = "THREE";
		$single[count($single)] = "FOUR";
		$single[count($single)] = "FIVE";
		$single[count($single)] = "SIX";
		$single[count($single)] = "SEVEN";
		$single[count($single)] = "EIGHT";
		$single[count($single)] = "NINE";
		$single[count($single)] = "TEN";
		$single[count($single)] = "ELEVEN";
		$single[count($single)] = "TWELVE";
		$single[count($single)] = "THIRTEEN";
		$single[count($single)] = "FOURTEEN";
		$single[count($single)] = "FIFTEEN";
		$single[count($single)] = "SIXTEEN";
		$single[count($single)] = "SEVENTEEN";
		$single[count($single)] = "EIGHTEEN";
		$single[count($single)] = "NINETEEN";
		
		$double = array();
		$double[count($double)] = "";
		$double[count($double)] = "";
		$double[count($double)] = "TWENTY";
		$double[count($double)] = "THIRTY";
		$double[count($double)] = "FORTY";
		$double[count($double)] = "FIFTY";
		$double[count($double)] = "SIXTY";
		$double[count($double)] = "SEVENTY";
		$double[count($double)] = "EIGHTY";
		$double[count($double)] = "NINETY";
		
		$amtWords = array();
		$amtWords["single"] = $single;
		$amtWords["double"] = $double;
		$amtWords["thousand"] = " THOUSAND ";
		$amtWords["hundred"] = " HUNDRED ";
		$amtWords["and"] = " AND ";
		$amtWords["andOne"] = "";
			
		return $amtWords;
	}
		
	function setAmtWordsFr()
	{
		// Not yet working
		
		$single = array();
		$single[count($single)] = "";
		$single[count($single)] = "ET UN";
		$single[count($single)] = "DEUX";
		$single[count($single)] = "TROIS";
		$single[count($single)] = "QUATRE";
		$single[count($single)] = "CINQ";
		$single[count($single)] = "SIX";
		$single[count($single)] = "SEPT";
		$single[count($single)] = "HUIT";
		$single[count($single)] = "NEUF";
		$single[count($single)] = "DIX";
		$single[count($single)] = "ONZE";
		$single[count($single)] = "DOUZE";
		$single[count($single)] = "TREIZE";
		$single[count($single)] = "QUATORZE";
		$single[count($single)] = "QUINZE";
		$single[count($single)] = "SEIZE";
		$single[count($single)] = "DIX-SEPT";
		$single[count($single)] = "DIX-HUIT";
		$single[count($single)] = "DIX-NEUF";
		
		$double = array();
		$double[count($double)] = "";
		$double[count($double)] = "";
		$double[count($double)] = "VINGT";
		$double[count($double)] = "TRENTE";
		$double[count($double)] = "QUARANTE";
		$double[count($double)] = "CINQUANTE";
		$double[count($double)] = "SOIXANTE";
		$double[count($double)] = "SOIXANTE-DIX";
		$double[count($double)] = "QUATRE-VINGTS";
		$double[count($double)] = "QUATRE-VINGT-DIX";
		
		$amtWords = array();
		$amtWords["single"] = $single;
		$amtWords["double"] = $double;
		$amtWords["thousand"] = " MILLE ";
		$amtWords["hundred"] = " CENT ";
		$amtWords["and"] = " ET ";
		$amtWords["andOne"] = "";
			
		return $amtWords;
	}
	
}	
	
?>