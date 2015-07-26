<?php
/**
 * @file
 * Contains \Drupal\Tests\flag\Integration\Action\ActionUnFlagTest.
 */

namespace Drupal\Tests\flag\Integration\RulesAction;

/**
 * Tests Class for flag_action_unflag rules action plugin.
 * @coversDefaultClass \Drupal\flag\Plugin\RulesAction\Flag
 * @group flag_action
 */
class ActionUnFlagTest extends FlagIntegrationTestBase {

  /**
   * Tests the summary.
   *
   * @covers ::summary
   */
  public function testSummary() {
    $flagServiceMock = $this->getFlagServiceMock([]);
    $this->container->set('flag', $flagServiceMock);

    $action = $this->getUnFlagAction();

    $this->assertEquals('unflag entity', $action->summary());
  }

  /**
   * Tests the execution of the flag action.
   *
   * @covers ::summary
   */
  public function testActionFlag() {

    $flagServiceMock = $this->getFlagServiceMock([]);
    $flagServiceMock
      ->expects($this->once())
      ->method('unflag')
      ->will($this->returnValue([]));
    $this->container->set('flag', $flagServiceMock);


    $node = $this->getMock('Drupal\node\NodeInterface');
    $flag = $this->getFlagMock();
    $action = $this->getUnFlagAction();
    $action->setContextValue('entity', $node);
    $action->setContextValue('flag', $flag);
    $action->execute();
  }

  /**
   * Helper function to create a 'flag_action_flag' action.
   *
   * @return object
   */
  protected function getUnFlagAction() {
    return $this->actionManager->createInstance('flag_action_unflag');
  }

}
