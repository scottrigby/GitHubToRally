<?php

namespace GitHubToRally;

use Symfony\Component\Yaml\Yaml;

class Config {

  /**
   * We define our own src directory, so we know project root is one level up.
   */
  const PROJECT_ROOT = __DIR__ . '/..';
  const YAML_FILE = self::PROJECT_ROOT . '/config.yml';

  /**
   * @var mixed
   *   A Yaml parsed PHP value.
   */
  protected $config;

  /**
   * Config constructor.
   * @param string $filename
   *   The Yaml config file path.
   */
  public function __construct($filename = self::YAML_FILE) {
    $this->config = $this::parseYaml($filename);
  }

  /**
   * Parses the Yaml config file into a PHP value.
   *
   * Yaml::parse already throws a ParseException if the file can not be parsed.
   *
   * @param string $filename
   *   The Yaml config file path.
   * @return mixed
   *   The return value of Yaml::parse.
   * @throws \Exception
   * @throws \Symfony\Component\Yaml\Exception\ParseException
   */
  protected static function parseYaml($filename) {
    if (!file_exists($filename)) {
      throw new \Exception('A config.yml file must exist in the project root.');
    }
    return Yaml::parse(file_get_contents($filename));
  }

  /**
   * Gets a config key value.
   *
   * @param string|null $key
   *   An optional Yaml key.
   * @return mixed
   *   The parsed Yaml config: If a key is specified, return the mapped value.
   *   Otherwise, return NULL (some future key values may be "FALSE", so we use
   *   NULL).
   */
  public function getValue($key = NULL) {
    return isset($this->config[$key]) ? $this->config[$key] : NULL;
  }

  /**
   * Helps other classes validate their own specified config keys.
   *
   * @param array $required
   * @throws \Exception
   */
  public function validateKeys($required = []) {
    foreach ($required as $key) {
      if (empty($this->getValue($key))) {
        throw new \Exception("You must specify a config value for: $key.");
      }
    }
  }

}
