<?php

namespace Drupal\custom_timezone\Service;

use Drupal\Core\Config\ConfigFactoryInterface;
use symfony\component\DependencyInjection\ContainerInterface;

/**
 * Service to handle time-related functionality.
 */
class TimeService {

  /**
   * The configuration factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a TimeService object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory service.
   */
   public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Get the country name from configuration.
   *
   * @return string
   *   The country name.
   */
  public function getCountryName() {
    $config = $this->configFactory->get('custom_timezone.country_city_config');
    return $config->get('country');
  }

  /**
   * Get the city name from configuration.
   *
   * @return string
   *   The city name.
   */
  public function getCityName() {
    $config = $this->configFactory->get('custom_timezone.country_city_config');
    return $config->get('city');
  }

  /**
   * Get the timezone from configuration.
   *
   * @return string
   *   The timezone.
   */
  public function getTimezone() {
    $config = $this->configFactory->get('custom_timezone.country_city_config');
    return $config->get('timezone');
  }

  // You can add other methods as needed.
}
