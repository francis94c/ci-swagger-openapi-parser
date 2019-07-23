<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swagger {

  private $ci;
  private $splint;

  function __construct() {
    $this->ci =& get_instance();
    $this->splint = $this->ci->load->splint("francis94c/openapi-parser");
    $this->splint->load->view("header");
  }
  /**
   * [parse description]
   * @param  string $file [description]
   * @return bool         [description]
   */
  function parse(string $file):bool {
    // Read API Spec File.
    $api_doc = json_decode(file_get_contents($file), true);
    if ($api_doc == null) return false;
    // Root Validations.
    if (!isset($api_doc["openapi"]) || !$api_doc["openapi"] === "3.0.0") {
      $this->error("Open API Specification Not Found/Supported.");
      return false;
    }
    // Parse Header.
    if (!$this->parse_header($api_doc)) return false;
    return true;
  }
  /**
   * [parse_title description]
   * @param  [type] $api_doc [description]
   * @return bool            [description]
   */
  private function parse_header(array &$api_doc):bool {
    if (!$this->validate_header($api_doc)) return false;
    $this->splint->load->view("title", [
      "title"       => $api_doc["info"]["title"],
      "version"     => $api_doc["info"]["version"],
      "description" => $api_doc["info"]["description"] ?? "",
      "openapi"     => $api_doc["openapi"]
    ]);
    return true;
  }
  /**
   * [validate_header description]
   * @param  [type] $api_doc [description]
   * @return [type]          [description]
   */
  private function validate_header(array &$api_doc):bool {
    // Title
    if (!$this->value_present($api_doc, "info.title")) {
      $this->error("API Title Absent.");
      return false;
    }
    // Version
    if (!$this->value_present($api_doc, "info.version")) {
      $this->error("API Version Absent.");
      return false;
    }
    return true;
  }
  /**
   * [value_exists description]
   * @param  array  $api_doc [description]
   * @param  string $path    [description]
   * @return bool            [description]
   */
  private function value_present(array $api_doc, string $path):bool {
    foreach(explode(".", $path) as $field) {
      $api_doc = isset($api_doc[$field]) ? $api_doc[$field] : null;
      if ($api_doc === null) return false;
    }
    return true;
  }
  private function error(string $message) {
    $this->splint->load->view("error", [
      "message" => $message
    ]);
  }
}
