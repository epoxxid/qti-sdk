<?php
/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * Copyright (c) 2013-2017 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 * @license GPLv2
 */

namespace qtism\data\content\ssml;

use qtism\data\content\FlowStatic;
use qtism\data\content\InlineStatic;
use qtism\data\ExternalQtiComponent;
use qtism\data\content\FlowTrait;

/**
 * From IMS QTI:
 *
 * This is one of the SSML annotation attributes. The 'sub' tag is employed to indicate that the text in the
 * alias attribute value replaces the contained text for pronunciation. This allows a document to contain both
 * a spoken and written form.
 *
 * @author Jérôme Bogaerts <jerome@taotesting.com>
 *
 */
class Sub extends ExternalQtiComponent implements FlowStatic, InlineStatic
{
    use FlowTrait;
    
    public function __construct($xmlString)
    {
        parent::__construct($xmlString);
    }
    
    public function getQtiClassName()
    {
        return 'sub';
    }
    
    protected function buildTargetNamespace()
    {
        $this->setTargetNamespace('http://www.w3.org/2010/10/synthesis');
    }
}
