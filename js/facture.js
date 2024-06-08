



/*            ______
             /  __  \
            /  /__\  \LINCKERS©               
           /  ___    /  __________
          /  /   \   \ /  _______/
         /  /     |   |  /roups_
        /  /     /   /  /  /_  /
       /   \___ /   /  /____/ /
       \__________ /\________/
 
 *****************************************
 *  facture - ver 1.2 | facture.js
 *  Created by McPeter - 19/08/2004
 *****************************************
 * - BLINCKERS© Groups & MonPremierSite© -
 *    http://www.blinckers-groups.com
 *    http://www.monpremiersite.com
 *****************************************
 * Fonctions JavaScript 
 *****************************************/

function Ident(Obj){ return (document.all)?document.all[Obj]:document.getElementById(Obj); } // Identification d'objet lib_js_1

function findNbChamp(){ var a=0; while(ChampDesign=Ident('ChampDesign_'+a)){ a++; } return a; } // Trouve le nombre de champs à calculer

function formatChamp(nombre){ // Retourne le nombre au format 2 chiffres après la virgule
	//var nb = nombre.toFixed(2)
	return Math.round(nombre*100)/100;
}

function calcul(){ // Calucule Les valeurs
	// Définition des variables
	var a=0, b=findNbChamp(), valueSousTotal=0;
	var valueTotalHT=Ident('valueTotalHT'), valueTVA=Ident('valueTVA'), valueTotalTTC=Ident('valueTotalTTC');
	var ChampTarifHT, ChampQte, ChampResult;
	for(a; a<b; a++){
		ChampTarifHT=Ident('ChampTarifHT_'+a).value;
			Ident('ChampTarifHT_'+a).value=formatChamp(ChampTarifHT);
		ChampQte=Ident('ChampQte_'+a).value;
			Ident('ChampQte_'+a).value=formatChamp(ChampQte);
		ChampResult=Ident('ChampResult_'+a);
		ChampResult.value=formatChamp(ChampTarifHT*ChampQte);
		valueSousTotal=valueSousTotal + (ChampTarifHT*ChampQte);
	}
	valueTotalHT.value=formatChamp(valueSousTotal);
	valueTVA.value=formatChamp(valueTotalHT.value*(20/100));
	valueTotalTTC.value=formatChamp(valueTotalHT.value*(1+(20/100)));


    window.document.getElementById('somme').value=calcule(valueTotalTTC.value);
}

function delLine(where){ // Fonction de suppression de ligne
	var a=0, b=findNbChamp(), c='', d='', e=0;
	var ChampDesign, ChampTarifHT, ChampQte, ChampResult;
	
	for(a; a<b; a++){
		ChampDesign=Ident('ChampDesign_'+a).value;
		ChampTarifHT=Ident('ChampTarifHT_'+a).value;
		ChampQte=Ident('ChampQte_'+a).value;
		ChampResult=Ident('ChampResult_'+a).value;
		if(a!=where){
			c='<input type="text" 	name=ChampDesign[] id="ChampDesign_'+e+'" value="'+ChampDesign+'" style="width:510px; text-align:left;" />'+"\n";
			c+='<input type="text" 	name=ChampTarifHT[] id="ChampTarifHT_'+e+'" value="'+ChampTarifHT+'" style="width:60px;" onchange="calcul()" />'+"\n";
			c+='<input type="text" 	name=ChampQte[] id="ChampQte_'+e+'" value="'+ChampQte+'" style="width:40px;" onchange="calcul()" />'+"\n";
			c+='<input type="text" 	name=ChampResult[] id="ChampResult_'+e+'" value="'+ChampResult+'" style="width:60px;" />&nbsp;'+"\n";
			
			c+='<input type="button" value="-." onclick="delLine('+e+')" class="Button" />&nbsp;'+"\n";
			
			d+='<p>'+"\n"+c+"\n"+'</p>'+"\n";
			e++;
		}else{
			e=a;
		}
	}
	Ident('ligneCalcul').innerHTML=d;
	calcul();
}

function addLine(where){ // Fonction d'ajout de ligne
	var a=0, b=findNbChamp(), c='', d='';
	var ChampDesign, ChampTarifHT, ChampQte, ChampResult;
	
	
	
	
	
	for(a; a<b; a++){
		ChampDesign=Ident('ChampDesign_'+a).value;
		ChampTarifHT=Ident('ChampTarifHT_'+a).value;
		ChampQte=Ident('ChampQte_'+a).value;
		ChampResult=Ident('ChampResult_'+a).value;

		c='<td><input type="text" 	name=ChampDesign[] id="ChampDesign_'+a+'" value="'+ChampDesign+'" style="width:510px; text-align:left;" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampTarifHT[] id="ChampTarifHT_'+a+'" value="'+ChampTarifHT+'" style="width:60px;" onchange="calcul()" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampQte[] id="ChampQte_'+a+'" value="'+ChampQte+'" style="width:40px;" onchange="calcul()" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampResult[] id="ChampResult_'+a+'" value="'+ChampResult+'" style="width:60px;" /></td>&nbsp;'+"\n";
		c+='<td><input type="button" value="-." onclick="delLine('+a+')" class="Button" /></td>&nbsp;'+"\n";
		d+='<p>'+"\n"+c+"\n"+'</p>'+"\n";
	}

	c='';
	c='<td><input type="text" 	name=ChampDesign[] id="ChampDesign_'+a+'" value="'+ChampDesign+'" style="width:510px; text-align:left;" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampTarifHT[] id="ChampTarifHT_'+a+'" value="'+ChampTarifHT+'" style="width:60px;" onchange="calcul()" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampQte[] id="ChampQte_'+a+'" value="'+ChampQte+'" style="width:40px;" onchange="calcul()" /></td>'+"\n";
		c+='<td><input type="text" 	name=ChampResult[] id="ChampResult_'+a+'" value="'+ChampResult+'" style="width:60px;" /></td>&nbsp;'+"\n";
		c+='<td><input type="button" value="-." onclick="delLine('+a+')" class="Button" /></td>&nbsp;'+"\n";
		d+='<p>'+"\n"+c+"\n"+'</p>'+"\n";
	
	Ident('ligneCalcul').innerHTML=d;
	calcul();
}








var res, plus, diz, s, un, mil, mil2, ent, deci, centi, pl, pl2, conj;
  
var t=["","Un","Deux","Trois","Quatre","Cinq","Six","Sept","Huit","Neuf"];
var t2=["Dix","Onze","Douze","Treize","Quatorze","Quinze","Seize","Dix-sept","Dix-huit","Dix-neuf"];
var t3=["","","Vingt","Trente","Quarante","Cinquante","Soixante","Soixante","Quatre-vingt","Quatre-vingt"];
  
  
  
//window.onload=calcule
  
function calcule(m){
    return trans(m);
}
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des deux parties du nombre;
function decint(n){
  
    switch(n.length){
        case 1 : return dix(n);
        case 2 : return dix(n);
        case 3 : return cent(n.charAt(0)) + " " + decint(n.substring(1));
        default: mil=n.substring(0,n.length-3);
            if(mil.length<4){
                un= (mil==1) ? "" : decint(mil);
                return un + mille(mil)+ " " + decint(n.substring(mil.length));
            }
            else{  
                mil2=mil.substring(0,mil.length-3);
                return decint(mil2) + million(mil2) + " " + decint(n.substring(mil2.length));
            }
    }
}
  
  
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des nombres entre 0 et 99, pour chaque tranche de 3 chiffres;
function dix(n){
    if(n<10){
        return t[parseInt(n)]
    }
    else if(n>9 && n<20){
        return t2[n.charAt(1)]
    }
    else {
        plus= n.charAt(1)==0 && n.charAt(0)!=7 && n.charAt(0)!=9 ? "" : (n.charAt(1)==1 && n.charAt(0)<8) ? " et " : "-";
        diz= n.charAt(0)==7 || n.charAt(0)==9 ? t2[n.charAt(1)] : t[n.charAt(1)];
        s= n==80 ? "s" : "";
  
        return t3[n.charAt(0)] + s + plus + diz;
    }
}
  
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des mots "cent", "mille" et "million"
function cent(n){
return n>1 ? t[n]+ " Cent" : (n==1) ? " Cent" : "";
}
  
function mille(n){
return n>=1 ? " Mille" : "";
}
  
function million(n){
return n>=1 ? " Millions" : " Million";
}
  
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// conversion du nombre
function trans(n){
  
    // vérification de la valeur saisie
    if(!/^\d+[.,]?\d*$/.test(n)){
        return "L'expression entrée n'est pas un nombre."
    }
  
    // séparation entier + décimales
    n=n.replace(/(^0+)|(\.0+$)/g,"");
    n=n.replace(/([.,]\d{2})\d+/,"$1");
    n1=n.replace(/[,.]\d*/,"");
    n2= n1!=n ? n.replace(/\d*[,.]/,"") : false;
  
    // variables de mise en forme
    ent= !n1 ? "" : decint(n1);
    deci= !n2 ? "" : decint(n2);
    if(!n1 && !n2){
        return  "Zéro"
    }
    conj= !n2 || !n1 ? "" : "  et ";
    euro= !n1 ? "" : !/[23456789]00$/.test(n1) ? " Dirham": "s Dirham";
    centi= !n2 ? "" : " centime";
    pl=  n1>1 ? "s" : "";
    pl2= n2>1 ? "s" : "";
  
    // expression complète en toutes lettres
    return ("" + ent + euro + pl + conj + deci + centi + pl2).replace(/\s+/g," ").replace("cents E","cents E") ;
  
}