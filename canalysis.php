<?php 
include("conn.php");
include("firebasedata.php");
$GLOBALS['x'] = 0;
$GLOBALS['a'] = 0;
$GLOBALS['b']=0;
$GLOBALS['text'] = array();
$GLOBALS['audio'] = array();
$GLOBALS['video'] = array();
$GLOBALS['final'] = array();
$GLOBALS['result'] = array();
// echo $x
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/css/uikit.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.10.1/dist/js/uikit-icons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="https://d3js.org/d3.v4.min.js"></script>
		<style>
			body {
				font-family: 'Montserrat';
				font-size: 20px;
                height: 100vh;
			}
		</style>
  </head>
    <body>
            <div class="uk-background-secondary uk-light uk-padding uk-panel">
				<h1 class="uk-heading-line uk-text-center uk-padding-remove-top">
                    <span>
                    Brand Monitoring using Multimodal Sentiment Analysis
                    </span>
                </h1>
				<div class="uk-child-width-expand@s uk-text-center uk-margin-medium-right" uk-grid>
                <div>
						<table class="uk-table uk-margin-medium-left uk-table-hover uk-table-divider">
                    <thead>
                        <tr>
                            <th class="uk-text-center">File ID</th>
                            <th class="uk-text-center">Text</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $ref_table3="6"; 
                                            
                                            $fetchdata4 =$database->getReference($ref_table3)->getValue(); 
                                            foreach($fetchdata4 as $keys4){ 
                                                
                                            
                                            foreach($keys4 as $key4 => $row4){ 

                                            
                                                ?> 
                            <td>
                                <?php echo $row4["ID"]; 
                                ?>
                                
                            </td> 
                            <td height="40">
                                    
                                        <?php
                                        $GLOBALS['x']=$row4["ID"];
                                            if($row4["Negative"] > $row4["Neutral"]
                                            AND
                                            $row4["Negative"]>$row4["Positive"])
                                            { echo "Negative";
                                                array_push($GLOBALS['text'],"Negative");
												$ans3=0;} 
                                            elseif($row4["Negative"] < $row4["Neutral"]
                                            AND
                                            $row4["Neutral"]>$row4["Positive"])
                                            { echo "Neutral";
                                                array_push($GLOBALS['text'],"Neutral");
												$ans3=5;}
                                            else{ echo "Positive";
                                                array_push($GLOBALS['text'],"Positive");
													$ans3=10;} 
                                        ?>
                                    

                               
                            </td>
                            
                        </tr>
                        <?php } } 
                       
                        //echo $x; ?> 
                        
                        
                    </tbody>
                </table>
					</div>
                    <div>
						<table class="uk-table uk-margin-medium-left uk-table-hover uk-table-divider">
                    <thead>
                        <tr>
                            
                            <th class="uk-text-center">Audio</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $ref_table2="5"; 
                                            $fetchdata3 =$database->getReference($ref_table2)->getValue(); 
                                            foreach($fetchdata3 as $keys3){
                                        
                                            foreach($keys3 as $key3 => $row3){ ?> 
                          
                            <td height="40">
                            <a class="uk-button uk-button-default" href="#modal-full1" uk-toggle>
                                        <?php
                                            
                                            $GLOBALS['a']=$row3["ID"];
                                            
                                            if($row3["Angry"]+$row3["Sad"]+$row3["Fear"]+$row3["Sarcastic"] > $row3["Neutral"]
                                            AND
                                            $row3["Angry"]+$row3["Sad"]+$row3["Fear"]+$row3["Sarcastic"]>$row3["Happy"]+$row3["Surprise"])
                                            { echo "Negative";
                                                array_push($GLOBALS['audio'],"Negative");
												$ans1=0;} 

                                            elseif($row3["Angry"]+$row3["Sad"]+$row3["Fear"] +$row3["Sarcastic"]<= $row3["Neutral"]
                                            AND $row3["Neutral"]>=$row3["Happy"]+$row3["Surprise"]) 
                                            { echo "Neutral";
                                                array_push($GLOBALS['audio'],"Neutral");
												$ans1=5;}
                                            // elseif($row2["Negative"] =1){echo "Negative";}
                                            // elseif($row2["Positive"] =1){echo "Positive";}
                                            // elseif($row2["Neutral"] =1){echo "Neutral";} 
                                            else{ echo "Positive";
                                                array_push($GLOBALS['audio'],"Positive");
													$ans1=10;} 
                                            
                                        // print_r($GLOBALS['audio']);            
                                        ?>
                                    </a>
                                    <div id="modal-full1" class="uk-modal-full" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                                        <div class="uk-grid-collapse uk-child-width-2-2@s uk-flex-middle" uk-grid>
                                            <div class="uk-padding-large">
                                                <h1>Detailed Analysis</h1>
                                                <table class="uk-table uk-table-hover uk-table-divider">
                                                    <thead>
                                                        <tr>
                                                            <th>File ID</th>      
                                                            <th>Angry</th>
                                                            <th>Fear</th>
                                                            <th>Sarcastic</th>
                                                            <th>Disgust</th>
                                                            <th>Happy</th>
                                                            <th>Sad</th>
                                                            <th>Surprise</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                        <?php
                                                            foreach($keys3 as $key3 => $row3){?> 
                                                             <?php ?>
                                                            <td><?php echo $row3["ID"];?></td>
                                                            <td><?php echo $row3["Angry"];?></td>
                                                            <td><?php echo $row3["Fear"];?></td>
                                                            <td><?php echo $row3["Sarcastic"];?></td>
                                                            <td><?php echo $row3["Disgust"];?></td>
                                                            <td><?php echo $row3["Happy"];?></td>
                                                            <td><?php echo $row3["Sad"];?></td>
                                                            <td><?php echo $row3["Surprise"];?></td>
                                                        </tr><?php } ?> 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </td>
                            
                        </tr>
                        <?php } }
                        foreach(range($GLOBALS['a'],$GLOBALS['x']-1) as $number) { ?>
                            <tr>
                                <td height="40">
                                    <?php echo "NA"; 
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        
                       
                        
                    </tbody>
                </table>
					</div>
					<div>
						<table class="uk-table uk-margin-medium-left uk-table-hover uk-table-divider">
                    <thead>
                        <tr>
                            <!-- <th class="uk-text-center">File ID</th> -->
                            <th class="uk-text-center">Video</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $ref_table1="4"; 
                                            $fetchdata2 =$database->getReference($ref_table1)->getValue(); 
                                            foreach($fetchdata2 as $keys2){ 
                                            foreach($keys2 as $key2 => $row2){ ?> 
                            <!-- <td>
                                <?php echo $row2["ID"]; ?>
                                
                            </td>  -->
                            <td>
                                    <a class="uk-button uk-button-default" href="#modal-full" uk-toggle>
                                        <?php
                                        $GLOBALS['b']=$row2["ID"];
                                            if($row2["Angry"]+$row2["Sad"]+$row2["Fear"] > $row2["Neutral"]
                                            AND
                                            $row2["Angry"]+$row2["Sad"]+$row2["Fear"]>$row2["Happy"]+$row2["Surprise"])
                                            { echo "Negative";
                                                array_push($GLOBALS['video'],"Negative");
												$ans1=0;} 
                                            elseif($row2["Angry"]+$row2["Sad"]+$row2["Fear"] <= $row2["Neutral"]
                                            AND $row2["Neutral"]>=$row2["Happy"]+$row2["Surprise"]) 
                                            { echo "Neutral";
                                                array_push($GLOBALS['video'],"Neutral");
												$ans1=5;}
                                            // elseif($row2["Negative"] =1){echo "Negative";}
                                            // elseif($row2["Positive"] =1){echo "Positive";}
                                            // elseif($row2["Neutral"] =1){echo "Neutral";} 
                                            else{ echo "Positive";
                                                array_push($GLOBALS['video'],"Positive");
													$ans1=10;} 
                                        //print_r($GLOBALS['video']);
                                        ?>
                                    </a>

                                <div id="modal-full" class="uk-modal-full" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                                        <div class="uk-grid-collapse uk-child-width-2-2@s uk-flex-middle" uk-grid>
                                            <div class="uk-padding-large">
                                                <h1>Detailed Analysis</h1>
                                                <table class="uk-table uk-table-hover uk-table-divider">
                                                    <thead>
                                                        <tr>
                                                            <th>File ID</th>      
                                                            <th>Angry</th>
                                                            <th>Disgust</th>
                                                            <th>Fear</th>
                                                            <th>Happy</th>
                                                            <th>Neutral</th>
                                                            <th>Sad</th>
                                                            <th>Surprise</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                        <?php
                                                            foreach($keys2 as $key2 => $row2){?> 
                                                             <?php ?>
                                                            <td><?php echo $row2["ID"];?></td>
                                                            <td><?php echo $row2["Angry"];?></td>
                                                            <td><?php echo $row2["Disgust"];?></td>
                                                            <td><?php echo $row2["Fear"];?></td>
                                                            <td><?php echo $row2["Happy"];?></td>
                                                            <td><?php echo $row2["Neutral"];?></td>
                                                            <td><?php echo $row2["Sad"];?></td>
                                                            <td><?php echo $row2["Surprise"];?></td>
                                                        </tr><?php } ?> 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                        <?php } } 
                            foreach(range($GLOBALS['b'],$GLOBALS['x']-1) as $number) { ?>
                            <tr>
                                <td height="40">
                                    <?php echo "NA"; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        
                    </tbody>
                </table>
					</div>
					
					
					<!-- <div>
					<table class="uk-table uk-margin-medium-left uk-table-hover uk-table-divider">
                    <thead>
                        <tr>
                            
                            <th class="uk-text-center">Final Sentiment</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr> -->
                       <?php 
                       
                       $w=0;
                       
                       foreach(range(0,count($GLOBALS['text'])-1) as $number1) { 
                        $a=0;
                        
                       if($GLOBALS['text'][$a] == "Positive" AND $GLOBALS['audio'][$a] == "Positive"){ array_push($GLOBALS['result'],"Positive"); $a=$a+1;}
                       elseif($GLOBALS['text'][$a] == "Negative" AND $GLOBALS['audio'][$a] == "Negative"){ array_push($GLOBALS['result'],"Negative"); $a=$a+1;}
                       elseif($GLOBALS['text'][$a] == "Neutral" AND $GLOBALS['audio'][$a] == "Neutral"){ array_push($GLOBALS['result'],"Neutral"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] == "Positive" AND $GLOBALS['audio'][$a] == "Positive"){ array_push($GLOBALS['result'],"Positive"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] == "Positive" AND $GLOBALS['text'][$a] == "Positive"){ array_push($GLOBALS['result'],"Positive"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] == "Negative" AND $GLOBALS['audio'][$a] == "Negative"){ array_push($GLOBALS['result'],"Negative"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] == "Negative" AND $GLOBALS['text'][$a] == "Negative"){ array_push($GLOBALS['result'],"Negative"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] == "Neutral" AND $GLOBALS['audio'][$a] == "Neutral"){ array_push($GLOBALS['result'],"Neutral"); $a=$a+1;}
                       elseif($GLOBALS['video'][$a] =="Neutral" AND $GLOBALS['text'][$a] == "Neutral"){ array_push($GLOBALS['result'],"Neutral"); $a=$a+1;}
                       //elseif($GLOBALS['video']=="NA" AND $GLOBALS['text']; ) 
                    //    else{array_push($GLOBALS['result'],$GLOBALS['text']);}
                    else{array_push($GLOBALS['result'],"NA");}
                        
                       }
                    //    foreach(range(0,count($GLOBALS['result'])-1) as $number) {  ?>
                    <!-- //         <tr>
                    //             <td height="40">
                    //                 <?php print_r($GLOBALS['result'][$w]);
                    //                 echo $a;
                    //                 $w=$w+1; ?>
                    //             </td>
                    //         </tr> -->
                           <?php // } 
                    //         print_r($GLOBALS["result"]);
                    //     //echo $GLOBALS['video'];?>
                        </tr>
                        
                        
                    </tbody>
                </table>
					</div>
				</div>

                
             </div>
					
        <div class="uk-background-secondary uk-light uk-padding uk-panel">
            <p class="uk-h4" >
                
            </p>
        </div>
        <div class="uk-background-secondary uk-light uk-padding uk-panel">
            <p class="uk-h4 uk-margin-small-bottom" >
                <a class="uk-button uk-button-danger uk-position-center" href="index.php">Home</a>
            </p>
        </div>
        
    </body>
</html>
