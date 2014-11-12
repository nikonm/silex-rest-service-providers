<?php
namespace MJanssen\Event\Listener;

use MJanssen\Assets\Entity\Test;
use MJanssen\Event\RestGetEvent;
use PHPUnit_Framework_TestCase;

class ObjectRepositoryListenerTest extends PHPUnit_Framework_TestCase
{

    public function testObjectSetInEvent()
    {
        $event = new RestGetEvent();
        $event->setObjectRepository(
            $this->getObjectRepositoryMock()
        );

        $event->setIdentifier(1);

        $listener = new ObjectRepositoryListener();
        $listener->setObject($event);

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $event->getObject()
        );
    }


    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object identifier is not set
     */
    public function testExceptionIfObjectIdentifierIsNotSet()
    {
        $event = new RestGetEvent();

        $event->setObjectRepository(
            $this->getObjectRepositoryMock()
        );

        $listener = new ObjectRepositoryListener();
        $listener->setObject($event);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object repository is not set
     */
    public function testExceptionIfObjectRepositoryIsNotSet()
    {
        $event = new RestGetEvent();

        $event->setIdentifier(1);

        $listener = new ObjectRepositoryListener();
        $listener->setObject($event);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectRepositoryMock()
    {
        $objectRepository = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
                                 ->disableOriginalConstructor()
                                 ->setMethods(array('find'))
                                 ->getMockForAbstractClass();

        $objectRepository->expects($this->any())
                         ->method('find')
                         ->will($this->returnValue(
                              new Test()
                         ));

        return $objectRepository;
    }
} 