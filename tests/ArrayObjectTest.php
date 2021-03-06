<?php
/**
 * @package Array Object
 * @license MIT
 * @author denis909
 */
use Denis909\ArrayObject\ArrayObject;

class ArrayObjectTest extends \PHPUnit\Framework\TestCase
{

    protected function _createArrayObject(array $config = [])
    {
        return new ArrayObject(
            array_merge(
                [
                    'param1' => 'value 1',
                    'param2' => 'value 2'
                ], 
                $config
            )
        );
    }

    public function testCreate()
    {
        try
        {
            $object = $this->_createArrayObject();
        }
        catch(Exception $e)
        {
            $this->assertTrue(false, $e->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testProperties()
    {
        $object = $this->_createArrayObject();

        $this->assertEquals($object->param1, 'value 1');

        $this->assertEquals($object->param2, 'value 2');

        $this->assertEquals($object['param1'], 'value 1');

        $this->assertEquals($object['param2'], 'value 2');
    }

    public function testNotExistsProperty()
    {
        $object = $this->_createArrayObject();

        $this->expectException(Exception::class);

        $object->param0;
    }
 
    public function testNotExistsOffset()
    {
        $object = $this->_createArrayObject();

        $this->expectException(Exception::class);

        $object['param0'];
    }

    public function testUnsetArray()
    {
        $object = $this->_createArrayObject();

        unset($object['param1']);

        $this->expectException(Exception::class);

        $temp = $object['param1'];
    }

    public function testUnsetObject()
    {
        $object = $this->_createArrayObject();

        unset($object->param1);

        $this->expectException(Exception::class);

        $temp = $object->param1;
    }

    public function testToArray()
    {
        $obj = $this->_createArrayObject();

        $arr = (array) $obj;

        $this->assertArrayHasKey('param1', $arr);

        $this->assertArrayHasKey('param2', $arr);
    }

}