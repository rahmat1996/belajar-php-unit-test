<?php

namespace Rahmat1996\Test;

use Exception;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ProductServiceMockTest extends TestCase
{
    private ProductRepository $repository;
    private ProductService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ProductRepository::class);
        $this->service = new ProductService($this->repository);
    }

    // test stub
    public function testStub()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->method("findById")->willReturn($product);

        $result = $this->repository->findById("1");
        Assert::assertSame($product, $result);
    }

    // test stub using map
    public function testStubMap()
    {
        $product1 = new Product();
        $product1->setId("1");

        $product2 = new Product();
        $product2->setId("2");

        $map = [
            ["1", $product1],
            ["2", $product2]
        ];

        $this->repository->method("findById")->willReturnMap($map);

        Assert::assertSame($product1, $this->repository->findById("1"));
        Assert::assertSame($product2, $this->repository->findById("2"));
    }

    // test stub using callback
    public function testStubCallback()
    {
        $this->repository->method("findById")->willReturnCallback(function (string $id) {
            $product = new Product();
            $product->setId($id);
            return $product;
        });

        Assert::assertEquals("1", $this->repository->findById("1")->getId());
        Assert::assertEquals("2", $this->repository->findById("2")->getId());
        Assert::assertEquals("3", $this->repository->findById("3")->getId());
    }

    // test stub integrate to unit test
    public function testRegisterSuccess()
    {
        $this->repository->method("findById")->willReturn(null);
        $this->repository->method("save")->willReturnArgument(0);

        $product = new Product();
        $product->setId("1");
        $product->setName("Contoh");

        $result = $this->service->register($product);

        Assert::assertEquals($product->getId(), $result->getId());
        Assert::assertEquals($product->getName(), $result->getName());
    }

    // test stub, but failed test, so will throw exception
    public function testRegisterException()
    {

        $this->expectException(\Exception::class);

        // product on db, so if register with same product will throw exception
        $productInDb = new Product();
        $productInDb->setId("1");

        $this->repository->method("findById")->willReturn($productInDb);

        $product = new Product();
        $product->setId("1");

        $this->service->register($product);
    }

    // test delete success
    public function testDeleteSuccess()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->expects(self::once())->method("delete")->with(self::equalTo($product));

        $this->repository->method("findById")->willReturn($product)->with(self::equalTo("1"));

        $this->service->delete("1");

        Assert::assertTrue(true, "Success delete");
    }

    // test delete failed
    public function testDeleteFailed()
    {
        $this->repository->expects(self::never())->method("delete");
        $this->expectException(\Exception::class);
        $this->repository->method("findById")->willReturn(null)->with(self::equalTo("1"));
        $this->service->delete("1");
    }

    // test mock
    public function testMock()
    {
        $product = new Product();
        $product->setId("1");

        $this->repository->expects(self::once())->method("findById")->willReturn($product);

        $result = $this->repository->findById("1");
        Assert::assertSame($product, $result);
    }
}
