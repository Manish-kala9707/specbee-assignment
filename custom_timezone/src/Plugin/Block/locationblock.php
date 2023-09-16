<?php
namespace Drupal\custom_timezone\Plugin\Block;

use Drupal\custom_timezone\TimeService;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use symfony\component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;


/**
 * Provides a custom block.
 *
 * @Block(
 *   id = "your_module_custom_block",
 *   admin_label = @Translation("Custom Block"),
 *   category = @Translation("Custom")
 * )
 */
class LocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The custom timezone service.
   *
   * @var \Drupal\custom_timezone\TimeService
   */
  protected $exampleService;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $plugin = new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );

    $plugin->exampleService = $container->get('custom_timezone.time_service');

    return $plugin;
  }

  /**
   * {@inheritdoc}
   */

   
public function build() {
  $build = [];
    $country = $this->exampleService->getCountryName();
    $city = $this->exampleService->getCityName();
    $selectedTimezone = $this->exampleService->getTimezone();
    $currentDateTime = new \DateTime('now', new \DateTimeZone($selectedTimezone));
    $formatteddateTime = $currentDateTime->format('jS M Y');
    $timeFormat = 'g:i A'; // Format for hours, minutes, and AM/PM.
    $formattedTime = $currentDateTime->format($timeFormat);
    $dayOfWeekFormat = 'l'; // Format for the full day of the week.
    $formattedDayOfWeek = $currentDateTime->format($dayOfWeekFormat);

    $build['#attached']['drupalSettings']['custom_timezone']['timezone'] = $selectedTimezone;

    $content = [
          '#theme' => 'my_custom_block',
          '#formattedDayOfWeek' => $formattedDayOfWeek,
          '#formatteddateTime' => $formatteddateTime,
          '#selectedTimezone' => $selectedTimezone,
          '#city' => $city,
          '#country' => $country,
		];               
        
  $build['content'] = $content;
  $build['#cache']['max-age'] = 3600; // Cache for 1 hour.

  return $build;
}


  }


  


