<?php
namespace Civi\Api4\Generic\Traits;

/**
 * This trait adds the $current param to a Get action.
 *
 * @see \Civi\Api4\Event\Subscriber\IsCurrentSubscriber
 */
trait IsCurrentTrait {

  /**
   * Convenience filter for selecting items that are enabled and do not have a past end-date.
   *
   * Adding current = TRUE is a shortcut for
   *   WHERE is_active = 1 AND (end_date IS NULL OR end_date >= now)
   *
   * Adding current = FALSE is a shortcut for
   *   WHERE is_active = 0 OR end_date < now
   *
   * @var bool
   */
  protected $current;

  /**
   * @return bool
   */
  public function getCurrent() {
    return $this->current;
  }

  /**
   * @param bool $current
   * @return $this
   */
  public function setCurrent($current) {
    $this->current = $current;
    return $this;
  }

}
