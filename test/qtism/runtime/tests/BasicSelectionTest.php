<?php
require_once (dirname(__FILE__) . '/../../../QtiSmTestCase.php');

use qtism\runtime\tests\RouteItem;
use qtism\runtime\tests\SelectableRouteCollection;
use qtism\runtime\tests\SelectableRoute;
use qtism\runtime\tests\BasicSelection;
use qtism\data\storage\xml\XmlAssessmentTestDocument;

class BasicSelectionTest extends QtiSmTestCase {
    
    public function testBasicSelection() {
        $doc = new XmlAssessmentTestDocument();
        $doc->load(self::samplesDir() . 'custom/selection_and_ordering.xml');
        
        $testPart = $doc->getComponentByIdentifier('testPart');
        $this->assertEquals('testPart', $testPart->getIdentifier());
        
        $s01 = $doc->getComponentByIdentifier('S01', true);
        $this->assertEquals('S01', $s01->getIdentifier());
        
        // Prepare route selection of S01A.
        $s01a = $doc->getComponentByIdentifier('S01A', true);
        $this->assertEquals('S01A', $s01a->getIdentifier());
        
        $s01aRoute = new SelectableRoute();
        foreach ($s01a->getSectionParts() as $sectionPart) {
            $routeItem = new RouteItem($sectionPart, $s01a, $testPart);
            $s01aRoute->addRouteItem($routeItem);
        }
        
        // Prepare route selection of S01B.
        $s01b = $doc->getComponentByIdentifier('S01B', true);
        $this->assertEquals('S01B', $s01b->getIdentifier());
        
        $s01bRoute = new SelectableRoute();
        foreach ($s01b->getSectionParts() as $sectionPart) {
            $routeItem = new RouteItem($sectionPart, $s01b, $testPart);
            $s01bRoute->addRouteItem($routeItem);
        }
        
        $selection = new BasicSelection($s01, new SelectableRouteCollection(array($s01aRoute, $s01bRoute)));
        $selectedRoute = $selection->select();
        
        $routeCheck1 = self::isRouteCorrect($selectedRoute, array('Q1', 'Q2', 'Q3'));
        $routeCheck2 = self::isRouteCorrect($selectedRoute, array('Q4', 'Q5', 'Q6'));
        
        $this->assertFalse($routeCheck1 === true && $routeCheck2 === true);
        $this->assertTrue($routeCheck1 === true || $routeCheck2 === true);
    }
    
    private static function isRouteCorrect(SelectableRoute $route, array $expectedIdentifiers) {
        
        $i = 0;
        foreach ($route as $routeItem) {
            if ($routeItem->getAssessmentItemRef()->getIdentifier() !== $expectedIdentifiers[$i]) {
                return false;
            }
            
            $i++;
        }
        
        return true;
    }
}