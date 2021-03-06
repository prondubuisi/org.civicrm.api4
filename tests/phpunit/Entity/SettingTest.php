<?php

namespace Civi\Test\Api4\Entity;

use Civi\Api4\Setting;
use Civi\Test\Api4\UnitTestCase;

/**
 * @group headless
 */
class SettingTest extends UnitTestCase {

  public function testSettingASetting() {
    $setting = Setting::set()->addValue('menubar_position', 'above-crm-container')->setCheckPermissions(FALSE)->execute()->first();
    $this->assertEquals('above-crm-container', $setting['value']);
    $setting = Setting::get()->addSelect('menubar_position')->setCheckPermissions(FALSE)->execute()->first();
    $this->assertEquals('above-crm-container', $setting['value']);

    $setting = Setting::revert()->addSelect('menubar_position')->setCheckPermissions(FALSE)->execute()->indexBy('name')->column('value');
    $this->assertEquals(['menubar_position' => 'over-cms-menu'], $setting);
    $setting = civicrm_api4('Setting', 'get', ['select' => ['menubar_position'], 'checkPermissions' => FALSE], 0);
    $this->assertEquals('over-cms-menu', $setting['value']);
  }

  public function testInvalidSetting() {
    $message = '';
    try {
      Setting::set()->addValue('not_a_real_setting!', 'hello')->setCheckPermissions(FALSE)->execute();
    }
    catch (\API_Exception $e) {
      $message = $e->getMessage();
    }
    $this->assertContains('setting', $message);
  }

}
