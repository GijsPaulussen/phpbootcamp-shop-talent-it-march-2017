<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2016
 */


namespace Aimeos\Client\Html\Catalog\Detail\Actions;


class StandardTest extends \PHPUnit_Framework_TestCase
{
	private $object;


	protected function setUp()
	{
		$paths = \TestHelperHtml::getHtmlTemplatePaths();
		$this->object = new \Aimeos\Client\Html\Catalog\Detail\Actions\Standard( \TestHelperHtml::getContext(), $paths );
		$this->object->setView( \TestHelperHtml::getView() );
	}


	protected function tearDown()
	{
		unset( $this->object );
	}


	public function testGetHeader()
	{
		$view = $this->object->getView();
		$view->detailProductItem = $this->getProductItem();

		$output = $this->object->getHeader();
		$this->assertNotNull( $output );
	}


	public function testGetBody()
	{
		$view = $this->object->getView();
		$view->detailProductItem = $this->getProductItem();

		$output = $this->object->getBody();

		$this->assertStringStartsWith( '<!-- catalog.detail.actions -->', $output );
		$this->assertContains( 'actions-button-pin', $output );
		$this->assertContains( 'actions-button-watch', $output );
		$this->assertContains( 'actions-button-favorite', $output );
	}


	public function testModifyBody()
	{
		$content = '<!-- catalog.detail.actions -->test<!-- catalog.detail.actions -->';
		$output = $this->object->modifyBody( $content, -1 );

		$this->assertStringStartsWith( '<!-- catalog.detail.actions -->', $output );
	}


	public function testGetSubClient()
	{
		$this->setExpectedException( '\\Aimeos\\Client\\Html\\Exception' );
		$this->object->getSubClient( 'invalid', 'invalid' );
	}


	protected function getProductItem()
	{
		$manager = \Aimeos\MShop\Product\Manager\Factory::createManager( \TestHelperHtml::getContext() );
		$search = $manager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.code', 'CNC' ) );
		$items = $manager->searchItems( $search );

		if( ( $item = reset( $items ) ) === false ) {
			throw new \Exception( 'No product item with code "CNC" found' );
		}

		return $item;
	}
}
