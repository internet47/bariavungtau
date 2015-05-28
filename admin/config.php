<?php 
/*session_start(); 
if (!isset($_SESSION['username']) || isset($_SESSION['username'])=="")
{
	header("location: login.php");
}*/
?>

<?php
	$folder = 'data/';
	function create_table($table, $field = array())
	{
		global $folder;
		$xml = new DOMDocument('1.0','utf-8');
		$r = $xml->createElement("data");
		$xml->appendChild($r);
		foreach($field as $db)
		{
			$b = $xml->createElement('field');
			$name = $xml->createElement('name');
			$name->appendChild($xml->createTextNode($db));
			$b->appendChild($name);
			$r->appendChild($b);
		}
		$xml = $xml->Save($folder.$table.".xml");
	}
	
	function get_data($table,$field,$where='',$limit='0,0') {
    global $folder;
    $where = explode(',',$where);
    $limit = explode(',',$limit);
    $doc = new DOMDocument('1.0','utf-8');
    $doc->load( $folder.$table.".xml" );
    // Load field
    $tags = $doc->getElementsByTagName("field");
    $tagname = array();
    foreach($tags as $tag) {
        $names = $tag->getElementsByTagName("name");
        $name = $names->item(0)->nodeValue;
        $tagname[] = $name;
    }
    // Start get data
    $a = $doc->getElementsByTagName( $table );
    $data = array();
    if (in_array($field,$tagname)||$field=="*") {
        $f=0;$c=0;
        if (!$where[0]) {
            foreach($a as $b) { 
                if ($c==$limit[1]&$limit[1]!=0) break; 
                if ($limit[0]<=$f) {            
                    if($field=="*") {
                        for($i=0;$i<count($tagname);$i++) {
                            $d[$i] = $b->getElementsByTagName( $tagname[$i] );
                            $e[$i] = $d[$i]->item(0)->nodeValue;
                            
                            $data[$c][$tagname[$i]] = $e[$i];
                        }
                    }
                    else {
                        $d = $b->getElementsByTagName( $field );
                        $e = $d->item(0)->nodeValue;
                        
                        $data[$c][$field] = $e;
                    }
                    $c++;
                }
                $f++;
            }
        }
        else {
            foreach($a as $b) { 
                if ($c==$limit[1]&$limit[1]!=0) break;
                $checks = $b->getElementsByTagName( $where[0] );
                $check = $checks->item(0)->nodeValue;
                switch ($where[1]) {
                    case "<": 
                        $check<$where[2]?$check=true:$check=false;
                        break;
                    case ">":
                        $check>$where[2]?$check=true:$check=false;
                        break;
                    case "<=": 
                        $check<=$where[2]?$check=true:$check=false;
                        break;
                    case ">=":
                        $check>=$where[2]?$check=true:$check=false;
                        break;
                    case "=":
                        $check==$where[2]?$check=true:$check=false;
                        break;
                    case "!=":
                        $check!=$where[2]?$check=true:$check=false;
                        break;
                } 
                if ($check==true) {
                    if ($limit[0]<=$f) {  
                        if($field=="*") {
                            for($i=0;$i<count($tagname);$i++) {
                                $d[$i] = $b->getElementsByTagName( $tagname[$i] );
                                $e[$i] = $d[$i]->item(0)->nodeValue;
                                
                                $data[$c][$tagname[$i]] = $e[$i];
                            }
                        }
                        else {
                            $d = $b->getElementsByTagName( $field );
                            $e = $d->item(0)->nodeValue;
                            
                            $data[$c][$field] = $e;
                        }
                        $c++;
                    }
                    $f++;
                }
            }
        }
        
    }
    // If field not found
    else {
        $data[0][$field] = "Eror: Can't Select ".$field." From ".$table;
        break;
    }  
    
    return $data;
} 

// add database xml
function add_data($table,$add=array()) {
    global $folder;
    $doc = new DOMDocument('1.0','utf-8');
    $doc->load( $folder.$table.".xml" );
    // Load field
    $tags = $doc->getElementsByTagName( "field" );
    $tagname = array();
    foreach($tags as $tag) {
        $names = $tag->getElementsByTagName( "name" );
        $name = $names->item(0)->nodeValue;
        $tagname[] = $name;
    }
    // Start add data
    $a = $doc->getElementsByTagName( $table );
    $data = array();
    $c=1;
    for($i=0;$i<count($tagname);$i++) {$data[0][$tagname[$i]] = $add[$i];}
    foreach($a as $b) { 
        for($i=0;$i<count($tagname);$i++) {
            $d[$i] = $b->getElementsByTagName( $tagname[$i] );
            $e[$i] = $d[$i]->item(0)->nodeValue;
            $data[$c][$tagname[$i]] = $e[$i];
        }
        $c++;
    }
    
    $xml = new DOMDocument('1.0','utf-8');
  
    $r = $xml->createElement( "data" );
    $xml->appendChild( $r );
    
    foreach( $data as $db ) {
        $b = $xml->createElement( $table );
        
        for($i=0;$i<count($tagname);$i++) {
            $name = $xml->createElement( $tagname[$i] );
            $name->appendChild(
            $xml->createTextNode( $db[$tagname[$i]] )
            );
            $b->appendChild( $name );
        }
        
        $r->appendChild( $b );
    } 
    foreach( $tagname as $db ) {
        $b = $xml->createElement('field');
        
            $name = $xml->createElement('name');
            $name->appendChild(
            $xml->createTextNode( $db )
            );
            $b->appendChild( $name );
        
        $r->appendChild( $b );
    }
  
    $xml= $xml->save( $folder.$table.".xml" );
} 


// update database

function update_data($table,$field=array(),$update=array()) {
    global $folder;
    $doc = new DOMDocument('1.0','utf-8');
    $doc->load( $folder.$table.".xml" );
    // Load field
    $tags = $doc->getElementsByTagName("field");
    $tagname = array();
    foreach($tags as $tag) {
        $names = $tag->getElementsByTagName("name");
        $name = $names->item(0)->nodeValue;
        $tagname[] = $name;
    }
    // Start update data
    $a = $doc->getElementsByTagName($table);
    $data = array();
    $c=0;
    foreach($a as $b) { 
        $checks = $b->getElementsByTagName( $field[0] );
        $check = $checks->item(0)->nodeValue;
        if ($check!=$field[1]) {
            for($i=0;$i<count($tagname);$i++) {
                $d[$i] = $b->getElementsByTagName( $tagname[$i] );
                $e[$i] = $d[$i]->item(0)->nodeValue;
                $data[$c][$tagname[$i]] = $e[$i];
            }
            $c++;
        }
        else {
            for($i=0;$i<count($tagname);$i++) {
                $data[$c][$tagname[$i]] = $update[$i];
            }
            $c++;
        }
    }
    
    $xml = new DOMDocument('1.0','utf-8');
  
    $r = $xml->createElement("data");
    $xml->appendChild( $r );
    
    foreach( $data as $db ) {
        $b = $xml->createElement( $table );
        
        for($i=0;$i<count($tagname);$i++) {
            $name = $xml->createElement( $tagname[$i] );
            $name->appendChild(
            $xml->createTextNode( $db[$tagname[$i]] )
            );
            $b->appendChild( $name );
        }
        
        $r->appendChild( $b );
    } 
    foreach( $tagname as $db ) {
        $b = $xml->createElement('field');
        
            $name = $xml->createElement('name');
            $name->appendChild(
            $xml->createTextNode( $db )
            );
            $b->appendChild( $name );
        
        $r->appendChild( $b );
    }
  
    $xml= $xml->save( $folder.$table.".xml");
} 



function del_data($table,$field,$del=array()) {
    global $folder;
    $doc = new DOMDocument('1.0','utf-8');
    $doc->load( $folder.$table.".xml" );
    // Load field
    $tags = $doc->getElementsByTagName( "field");
    $tagname = array();
    foreach($tags as $tag) {
        $names = $tag->getElementsByTagName( "name" );
        $name = $names->item(0)->nodeValue;
        $tagname[] = $name;
    }
    // Start delete data
    $a = $doc->getElementsByTagName( $table );
    $data = array();
    $c=0;
    foreach($a as $b) { 
        $checks = $b->getElementsByTagName( $field );
        $check = $checks->item(0)->nodeValue;
        if (!in_array($check,$del)) {
            for($i=0;$i<count($tagname);$i++) {
                $d[$i] = $b->getElementsByTagName( $tagname[$i] );
                $e[$i] = $d[$i]->item(0)->nodeValue;
                $data[$c][$tagname[$i]] = $e[$i];
            }
            $c++;
        }
    }
    
    $xml = new DOMDocument('1.0','utf-8');
  
    $r = $xml->createElement( "data" );
    $xml->appendChild( $r );
    
    foreach( $data as $db ) {
        $b = $xml->createElement( $table );
        
        for($i=0;$i<count($tagname);$i++) {
            $name = $xml->createElement( $tagname[$i] );
            $name->appendChild(
            $xml->createTextNode( $db[$tagname[$i]] )
            );
            $b->appendChild( $name );
        }
        
        $r->appendChild( $b );
    }    
    foreach( $tagname as $db ) {
        $b = $xml->createElement( 'field' );
        
            $name = $xml->createElement( 'name' );
            $name->appendChild(
            $xml->createTextNode( $db )
            );
            $b->appendChild( $name );
        
        $r->appendChild( $b );
    }
  
    $xml= $xml->save( $folder.$table.".xml" );
} 



//create_table('images',array('id','title','description','link','image','date','status'));
//add_data('bigs',array('1','video streaming','this is video streaming','1'));
//add_data('bigs',array('2','video 2','video 2','0'));

//del_data('bigs','id',array('1'));  

//update_data('bigs',array('id','1'),array('10','1000000','mo ta','20'));
	
//var_dump(get_data('bigs','*')); 
/*
$data = get_data('bigs','*','id,=,1');
$str ='';
$str=$str.'<table width="50%" border="1">
			<tr>
				<td> Id </td>
				<td> Name </td>
				<td> Description </td>
				<td> Status </td>
			</tr>
			';
foreach($data as $val)
{
	//echo $val['id'];
	$str =$str.'<tr>
				<td>'.$val['id'].'</td>
				<td> '.$val['name'].' </td>
				<td> '.$val['description'].' </td>
				<td> '.$val['status'].' </td>
			</tr>';
	
}
$str=$str.'</table>';*/
//echo $str;



		
			
?>