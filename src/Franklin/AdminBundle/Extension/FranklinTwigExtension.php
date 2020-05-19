<?php

namespace Franklin\AdminBundle\Extension;

class FranklinTwigExtension extends \Twig_Extension
{
	public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('mes', array($this, 'mes')),
        );
    }

    public function mes($mes, $locale = "en")
    {
	    $result = $mes;

	    //Español
	    if (($mes == "January") and ($locale == "es")) {
	    	$result = 'Enero';
	    }
	    if (($mes == "February") and ($locale == "es")) {
	    	$result = 'Febrero';
	    }
	    if (($mes == "March") and ($locale == "es")) {
	    	$result = 'Marzo';
	    }
	    if (($mes == "April") and ($locale == "es")) {
	    	$result = 'Abril';
	    }
	    if (($mes == "May") and ($locale == "es")) {
	    	$result = 'Mayo';
	    }
	    if (($mes == "June") and ($locale == "es")) {
	    	$result = 'Junio';
	    }
	    if (($mes == "July") and ($locale == "es")) {
	    	$result = 'Julio';
	    }
	    if (($mes == "August") and ($locale == "es")) {
	    	$result = 'Agosto';
	    }
	    if (($mes == "September") and ($locale == "es")) {
	    	$result = 'Septiembre';
	    }
	    if (($mes == "October") and ($locale == "es")) {
	    	$result = 'Octubre';
	    }
	    if (($mes == "November") and ($locale == "es")) {
	    	$result = 'Noviembre';
	    }
	    if (($mes == "December") and ($locale == "es")) {
	    	$result = 'Diciembre';
	    }

	    //Português
	    if (($mes == "January") and ($locale == "pt")) {
	    	$result = 'Janeiro';
	    }
	    if (($mes == "February") and ($locale == "pt")) {
	    	$result = 'Fevereiro';
	    }
	    if (($mes == "March") and ($locale == "pt")) {
	    	$result = 'Março';
	    }
	    if (($mes == "April") and ($locale == "pt")) {
	    	$result = 'Abril';
	    }
	    if (($mes == "May") and ($locale == "pt")) {
	    	$result = 'Maio';
	    }
	    if (($mes == "June") and ($locale == "pt")) {
	    	$result = 'Junho';
	    }
	    if (($mes == "July") and ($locale == "pt")) {
	    	$result = 'Julho';
	    }
	    if (($mes == "August") and ($locale == "pt")) {
	    	$result = 'Agosto';
	    }
	    if (($mes == "September") and ($locale == "pt")) {
	    	$result = 'Setembro';
	    }
	    if (($mes == "October") and ($locale == "pt")) {
	    	$result = 'Outubro';
	    }
	    if (($mes == "November") and ($locale == "pt")) {
	    	$result = 'Novembro';
	    }
	    if (($mes == "December") and ($locale == "pt")) {
	    	$result = 'Dezembro';
	    }


	    //Italiano
	    if (($mes == "January") and ($locale == "it")) {
	    	$result = 'Gennaio';
	    }
	    if (($mes == "February") and ($locale == "it")) {
	    	$result = 'Febbraio';
	    }
	    if (($mes == "March") and ($locale == "it")) {
	    	$result = 'Marzo';
	    }
	    if (($mes == "April") and ($locale == "it")) {
	    	$result = 'Aprile';
	    }
	    if (($mes == "May") and ($locale == "it")) {
	    	$result = 'Maggio';
	    }
	    if (($mes == "June") and ($locale == "it")) {
	    	$result = 'Giugno';
	    }
	    if (($mes == "July") and ($locale == "it")) {
	    	$result = 'Luglio';
	    }
	    if (($mes == "August") and ($locale == "it")) {
	    	$result = 'Agosto';
	    }
	    if (($mes == "September") and ($locale == "it")) {
	    	$result = 'Settembre';
	    }
	    if (($mes == "October") and ($locale == "it")) {
	    	$result = 'Ottobre';
	    }
	    if (($mes == "November") and ($locale == "it")) {
	    	$result = 'Novembre';
	    }
	    if (($mes == "December") and ($locale == "it")) {
	    	$result = 'Decembre';
	    }

	    return $result;
    }
}