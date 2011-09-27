<?php
/**
 * @ version	$Id: AlphaToolbar.php 2008-11-06  v1.0.6$
 * @ package	AlphaToolbar
 * @ Copyright (C) 2008 by Bernard Gilly. All rights reserved.
 * @ license	GNU/GPL
 * @ Website    http://www.alphaplug.com
 * @
 * @ infos      Code for social-bookmark is a part of original module mod_social_bookmark for Joomla 1.0.x
 * @ Copyright (C) 2006-2008 by Alexander Hadj Hassine - All rights reserved
 * @ Website    http://www.social-bookmark-script.de/
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgContentalphatoolbar extends JPlugin {

	function plgContentalphatoolbar( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onPrepareContent( &$article, &$params, $limitstart )
	{
		global $mainframe;		

		$document	= & JFactory::getDocument();
		$view		= JRequest::getCmd('view');
		$print		= JRequest::getVar('print');
		
		if ( $view != 'article' ) return;		
	
		// Load language
		JPlugin::loadLanguage( 'plg_alphatoolbar', JPATH_ADMINISTRATOR );
		
		// Get plugin info
		$plugin =& JPluginHelper::getPlugin('content', 'alphatoolbar');
		$pluginParams = new JParameter( $plugin->params );
		
		if  ( !$pluginParams->get( 'atb_show_on_printpage',  0 ) && $print )  return;
		
		$excludeSectionID    = $pluginParams->get( 'excludeSectionID',  '' );		
		$excludeCategoryID   = $pluginParams->get( 'excludeCategoryID', '' );
		$excludeID           = $pluginParams->get( 'excludeID',         '' );		
		$listexcludeSection  = @explode ( ",",  $excludeSectionID );	
		$listexcludeCategory = @explode ( ",", $excludeCategoryID );	
		$listexclude 		 = @explode ( ",",         $excludeID );		
		
		$atb_show_icons_resize_text = $pluginParams->def( 'atb_show_icons_resize_text', 1 );
		$atb_show_icon_hits			= $pluginParams->def( 'atb_show_icon_hits',   1 );
		$atb_show_go_top_link 		= $pluginParams->def( 'atb_show_go_top_link', 1 );
		$atb_include_pdf      		= $pluginParams->def( 'atb_include_pdf',      1 );
		$atb_include_print    		= $pluginParams->def( 'atb_include_print',    1 );
		$atb_include_mail     		= $pluginParams->def( 'atb_include_mail',     1 );
		$atb_include_tags     		= $pluginParams->def( 'atb_include_tags',     1 );
		$atb_position     			= $pluginParams->def( 'atb_position',         1 );
		
		if ( $params->get( 'intro_only' ) || in_array ( $article->id, $listexclude ) || in_array ( $article->sectionid, $listexcludeSection ) || in_array ( $article->catid, $listexcludeCategory ) ) return;
		
		/* prepare content toc */
		$contenttoc  = "";		
		if ( isset($article->toc) ) {			
			$article->toc = str_replace('class="toclink"','class="sublevel-toolbar-article-horizontal"',$article->toc);			
			if ( preg_match('#<th>(.*)</th>#Uis', $article->toc, $m) ) {
				$contenttoc = "<li><a href=\"#\" class=\"mainlevel-toolbar-article-horizontal\"><span class=\"expanded\"><img src=\"plugins/content/alphatoolbar/images/icon-indexpage.gif\" alt=\"\" border=\"0\" />" . $m[1] . "</span></a>";
			}
			if ( preg_match_all('#<a href=(.*)</a>#Uis', $article->toc, $m) ) {						
				$contenttoc .= "<ul id=\"menulist_1-toolbar-article-horizontal\">\n";
				for ($i=0, $n=count($m[0]); $i < $n; $i++) {			
					$contenttoc .= "<li>" . $m[0][$i] . "</li>";					
				}
				$contenttoc .= "</ul>\n</li>\n";
			}			
			$article->toc = "";
		}
		
		// Add style sheet
		$document->addStyleSheet(JURI::base(true).'/plugins/content/alphatoolbar/css/toolbararticlemenu.css');		
		$document->addStyleSheet(JURI::base(true).'/plugins/content/alphatoolbar/css/small.css', 'text/css', 'screen', array( 'title' => 'small text' ));
		$document->addStyleSheet(JURI::base(true).'/plugins/content/alphatoolbar/css/medium.css', 'text/css', 'screen', array( 'title' => 'medium text' ));
		$document->addStyleSheet(JURI::base(true).'/plugins/content/alphatoolbar/css/large.css', 'text/css', 'screen', array( 'title' => 'large text' ));
		
		// Add Javascript
		$document->addScript(JURI::base(true).'/plugins/content/alphatoolbar/js/menu.js');
		$document->addScript(JURI::base(true).'/plugins/content/alphatoolbar/js/switcher.js');	
		
		$document->addScriptDeclaration("window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });");
		
		$pdf = "";
		if( $params->get('show_pdf_icon') && $atb_include_pdf ) {
			$url  = "index.php?view=article";
			$url .=  @$article->catslug ? "&amp;catid=".$article->catslug : "";
			$url .= "&amp;id=" . $article->slug . "&amp;format=pdf&amp;option=com_content";		
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';		
			$linkpdf = JRoute::_($url);		
			$pdf = "<li><a href=\"" . $linkpdf . "\" onclick=\"window.open(this.href,'win2','".$status."'); return false;\" class=\"mainlevel-toolbar-article-horizontal\" rel=\"nofollow\" ><img src=\"plugins/content/alphatoolbar/images/icon-pdf.gif\" alt=\"\" border=\"0\" />" . JTEXT::_('ATB_EXPORTPDF') . "</a></li>";
			$params->set('show_pdf_icon', 0);
		}
		
		$print = "";
		if( $params->get('show_print_icon') && $atb_include_print ) {
			$url  = "index.php?view=article";
			$url .=  @$article->catslug ? "&amp;catid=".$article->catslug : "";
			$url .= "&amp;id=" . $article->slug . "&tmpl=component&print=1&option=com_content";		
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';		
			$linkprint = JRoute::_($url);		
			$print = "<li><a href=\"" . $linkprint . "\" onclick=\"window.open(this.href,'win2','".$status."'); return false;\" class=\"mainlevel-toolbar-article-horizontal\" rel=\"nofollow\" ><img src=\"plugins/content/alphatoolbar/images/icon-print.gif\" alt=\"\" border=\"0\" />" . JTEXT::_('ATB_PRINT') . "</a></li>";
			$params->set('show_print_icon', 0);
		}
		
		$email = "";		
		if( $params->get('show_email_icon') && $atb_include_mail ) {
			$uri     =& JURI::getInstance();
			$base  = $uri->toString( array('scheme', 'host', 'port'));
			$link    = $base.JRoute::_( "index.php?view=article&id=" . $article->slug, false );
			$url	= 'index.php?option=com_mailto&tmpl=component&link=' . base64_encode( $link );		
			$status = 'width=400,height=300,menubar=yes,resizable=yes';		
			$linkemail = JRoute::_($url);		
			$email = "<li><a href=\"" . $linkemail . "\" onclick=\"window.open(this.href,'win2','".$status."'); return false;\" class=\"mainlevel-toolbar-article-horizontal\" rel=\"nofollow\" ><img src=\"plugins/content/alphatoolbar/images/icon-email.gif\" alt=\"\" border=\"0\" />" . JTEXT::_('ATB_EMAIL') . "</a></li>";
			$params->set('show_email_icon', 0);
		}
		
		$tags = "";			
		if( $atb_include_tags && $article->metakey ) {		
			$keywords = array();
			$keywords = explode( "," , trim($article->metakey) );	
			$tags .= "<li><a href=\"#\" class=\"mainlevel-toolbar-article-horizontal\"><span class=\"expanded\"><img src=\"plugins/content/alphatoolbar/images/icon-tags.gif\" alt=\"\" border=\"0\" />" . JTEXT::_('ATB_TAGS') . "</span></a>";
			$tags .= "<ul id=\"menulist_2-toolbar-article-horizontal\">";
			for ($a=0, $b=count($keywords); $a < $b; $a++) {
				$metakey = trim($keywords[$a]);				
				$tags .= "<li><a href=\"" . JRoute::_("index.php?option=com_search&searchword=$metakey&submit=Search&searchphrase=any&ordering=newest") . "\" class=\"sublevel-toolbar-article-horizontal\">" . $metakey . "</a></li>";
			}
			$tags .="</ul>\n</li>\n";
		}
		
		// Build SocialBookmark list
		$social_links = $this->buildSocialBookmarkList( $pluginParams );
		
		// Prepare Icons Set for resize text
		if ( $atb_show_icons_resize_text && $atb_show_icon_hits) {			
			$seticonsresizetext = "<table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"5\">
			  <tr><td><span class=\"editlinktip hasTip\" title=\"" .  JTEXT::_('Hits')  . "::" . $article->hits . "\"><img src=\"plugins/content/alphatoolbar/images/icon-chart.gif\" alt=\"Hits\" border=\"0\" /></span></td><td>
			<a href=\"#\" onkeypress=\"setActiveStyleSheet('small text', 1); return false;\" onclick=\"setActiveStyleSheet('small text', 1); return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-small.gif\" alt=\"smaller text tool icon\" border=\"0\" /></a></td><td><a href=\"#\" onkeypress=\"setActiveStyleSheet('medium text', 1);return false;\" onclick=\"setActiveStyleSheet('medium text', 1);return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-medium.gif\" alt=\"medium text tool icon\" border=\"0\" /></a></td><td><a href=\"#\" onkeypress=\"setActiveStyleSheet('large text', 1);return false;\" onclick=\"setActiveStyleSheet('large text', 1);return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-large.gif\" alt=\"larger text tool icon\" border=\"0\" /></a>
				</td>
			  </tr>
			  </table>"
			  ;
		} elseif ( $atb_show_icons_resize_text && !$atb_show_icon_hits ) {		
			$seticonsresizetext = "<table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"5\">
			  <tr><td>
			<a href=\"#\" onkeypress=\"setActiveStyleSheet('small text', 1); return false;\" onclick=\"setActiveStyleSheet('small text', 1); return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-small.gif\" alt=\"smaller text tool icon\" border=\"0\" /></a></td><td><a href=\"#\" onkeypress=\"setActiveStyleSheet('medium text', 1);return false;\" onclick=\"setActiveStyleSheet('medium text', 1);return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-medium.gif\" alt=\"medium text tool icon\" border=\"0\" /></a></td><td><a href=\"#\" onkeypress=\"setActiveStyleSheet('large text', 1);return false;\" onclick=\"setActiveStyleSheet('large text', 1);return false;\"><img src=\"plugins/content/alphatoolbar/images/icon-large.gif\" alt=\"larger text tool icon\" border=\"0\" /></a>
				</td>
			  </tr>
			  </table>"
			  ;
		} elseif ( $atb_show_icon_hits && !$atb_show_icons_resize_text) {		
			$seticonsresizetext = "<table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"5\">
			  <tr><td><span class=\"editlinktip hasTip\" title=\"" .  JTEXT::_('Hits')  . "::" . $article->hits . "\"><img src=\"plugins/content/alphatoolbar/images/icon-chart.gif\" alt=\"Hits\" border=\"0\" /></span>
			  </td></tr>
			  </table>"
			  ;		
		} else $seticonsresizetext = "";

		// prepare html
		$html  = "";
		
		if ( $atb_position=='0' ) {
			$html .= "<div id=\"toolbar-articlebody\">\n";		
			$html .= $article->text;
			$html .= "</div>\n";
		}
		
		// toolbar html
		$html .= "<div id=\"toolbar-article\">\n";	
		$html .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
			  <tr><td width=\"95%\">
				<div class=\"menu-toolbar-article-horizontal\">
				<ul id=\"menulist_root-toolbar-article-horizontal\" class=\"mainlevel-toolbar-article-horizontal\" >					
					<li>
						<ul id=\"menulist_1-toolbar-article-horizontal\">" 
						. $social_links .
						"</ul>
					</li>\n" . $pdf . $print . $email .	$tags . $contenttoc . 
				"</ul>
				</div>
				</td>
			  <td width=\"5%\">\n"
			  . $seticonsresizetext .			  
			  "</td>\n
			   </tr>
			  </table>\n";				
		$html .= "</div>\n";
		// end div toolbar-article
		
		if ( $atb_position=='1' ) {
			$html .= "<div id=\"toolbar-articlebody\">\n";		
			$html .= $article->text;
			$html .= "</div>\n";
		}
		if ( $atb_show_go_top_link ) $html .= "<div class=\"backtotop\"><a href=\"#top-toolbar-article\" class=\"expandedtop\">" . JTEXT::_('ATB_TOPARTICLE') . "</a></div>\n";		
				
		$article->text = $html;
	}	
	
	function onBeforeDisplayContent( &$article, &$params, $limitstart )
	{
		global $mainframe;
		
		$view		= JRequest::getCmd('view');		
		$print		= JRequest::getVar('print');
		
		if ( $view != 'article' || $print ) return;
		
		// Get plugin info
		$plugin =& JPluginHelper::getPlugin('content', 'alphatoolbar');
		$pluginParams = new JParameter( $plugin->params );
		
		if ( !$pluginParams->get( 'atb_show_on_printpage',  0 ) && $print )  return;
		
		$atb_show_go_top_link = $pluginParams->def( 'atb_show_go_top_link', 1 );
		
		if ( $atb_show_go_top_link ) echo "<a name=\"top-toolbar-article\"></a>\n";
	}	

	function buildSocialBookmarkList ( $pluginParams )
	{
		global $mainframe;
	
		$description    = $mainframe->getCfg('MetaDesc');		
		$tags 			= str_replace('\n','', $mainframe->getCfg('MetaKeys') );
		$tags 			= trim($tags);
		$tags_space		= str_replace(',', ' ', $tags);
		$tags_semi 		= str_replace(',', ';', $tags);
		$tags_space 	= str_replace('  ', ' ', $tags_space);	
		
		$social_links   = "";		
		$imgImg         = JURI::base(true). "/plugins/content/alphatoolbar/images/";	
		$imgdir         = JURI::base(true). "/plugins/content/alphatoolbar/images/social/";	
		
		
		
		
		
		$social_links .= "";
	
		return $social_links;
	}	
}
?>