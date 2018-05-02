<html>
<head>   
<link href="calendar.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php

	$dayLabels = array("Seg","Ter","Qua","Qui","Sex","Sab","Dom");
    $currentYear=0;
    $currentMonth=0;
    $currentDay=0;
    $currentDate='';
    $daysInMonth=0;
    $naviHref='';
 
    /**
    * imprimir o calendario
    */
    $year  = '';
    $month = '';
         
    if($year==''&&isset($_GET['year'])){
        $year = $_GET['year'];
    } else if($year==''){
        $year = date("Y",time());	
        }    
         
    if($month==''&&isset($_GET['month'])){
        $month = $_GET['month'];
    } else if($month==''){
        $month = date("m",time());
    }   
		
    $currentYear=$year;
    $currentMonth=$month;
    $daysInMonth=_daysInMonth($month,$year);  
         
    echo "<div id='calendar'>"."<div class='box'>"._createNavi($currentYear, $currentMonth, $naviHref)."</div>".
                        "<div class='box-content'>"."<ul class='label'>"._createLabels($dayLabels)."</ul>";  
						
    echo "<div class='clear'></div>";     
    echo "<ul class='dates'>";    
                                 
    $weeksInMonth = _weeksInMonth($month,$year);
    
	// Create weeks in a month
    for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
        //Create days in a week
        for($j=1;$j<=7;$j++){
            _showDay($i*7+$j, $currentDay, $currentYear, $currentMonth, $daysInMonth);
			$currentDay++;
        }
    }
                                 
    echo "</ul>";
    echo "<div class='clear'></div>";          
    echo "</div>";
	echo "</div>";
     
   
	
	/**
    * create the li element for ul
    */
    function _showDay($cellNumber, $currentDay, $currentYear, $currentMonth, $daysInMonth){
         
        if($currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($currentYear.'-'.$currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
           
                $currentDay=1;
            }
        }
         
        if( ($currentDay!=0)&&($currentDay<=$daysInMonth) ){
             
            $currentDate = date('Y-m-d',strtotime($currentYear.'-'.$currentMonth.'-'.($currentDay)));
            $cellContent = $currentDay;
            $currentDay++;   
             
        }else{
             
            $currentDate = '';
            $cellContent='';
        }
             
        echo '<li id="li-'.$currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==''?'mask':'').'">'.$cellContent.'</li>';
        return;
    }
	
	
	/**
    * create navigation
    */
    function _createNavi($currentYear, $currentMonth, $naviHref){
         
        $nextMonth = $currentMonth==12?1:intval($currentMonth)+1;
        $nextYear = $currentMonth==12?intval($currentYear)+1:$currentYear;
        $preMonth = $currentMonth==1?12:intval($currentMonth)-1;
        $preYear = $currentMonth==1?intval($currentYear)-1:$currentYear;
         
        return
            '<div class="header">'.
                '<a class="prev" href="'.$naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($currentYear.'-'.$currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }
	
	
	/**
    * create calendar week labels
    */
    function _createLabels($dayLabels){  
                 
        $content='';
        foreach($dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }

	/**
    * calcular o numero de semanas num determinado mês
    */
    function _weeksInMonth($month,$year){
         
        if($year=='') {
            $year =  date("Y",time()); 
        }
         
        if($month=='') {
            $month = date("m",time());
        }
         
        // encontra o númnero de dias no mês
        $daysInMonths = _daysInMonth($month,$year);
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
        
        if($monthEndingDay<$monthStartDay){
            $numOfweeks++;
        }
        return $numOfweeks;
    }
	
	
	/**
    * calcular o numero de dias num determinado mês
    */
    function _daysInMonth($month,$year){
         
        if($year=='')
            $year =  date("Y",time()); 
 
        if($month=='')
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
	
?>
</body>
</html>   