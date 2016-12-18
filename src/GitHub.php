<?php

namespace GitHubToRally;

use GitHubWebhook\Handler;

/**
 * Class GitHub
 * @package GitHubToRally
 */
class GitHub {

  protected $handler;

  /**
   * GitHub constructor.
   * @param \GitHubWebhook\Handler $handler
   */
  public function __construct(Handler $handler) {
    $this->handler = $handler;
    $this->validate();
  }

  /**
   * Wraps Handler::validate() with an explanatory exception on failure.
   *
   * @throws \Exception
   */
  protected function validate() {
    if (!$this->handler->validate()) {
      throw new \Exception('Something went wrong. Either GitHub webhook
        $signature, $event, or $delivery are not present, or the GitHub
        signature does not match our GITHUB_WEBHOOK_SECRET environment
        variable.');
    }
  }

  /**
   * Syncs GitHub issues to Rally defects.
   *
   * @todo Decide how to divvy up method between this class and
   *   GitHubToRally\Rally.
   * @todo Create a Defect in the configured Rally project.
   * @todo Store the links between GitHub issues and Rally items (defects, and
   *   Stories if converted from a GitHub-created defect). Store where? In a
   *   database managed by this application? In some data storage area in the
   *   Rally defect/story (if such an option exists)?
   * @todo Sync the GitHub issue description with the Rally Defect description
   *   (and convert the GitHub flavored markdown to HTML for Rally's WYSIWYG).
   * @todo Add a comment to the Rally Defect's Discussion tab:
   *   > Join the discussion at: <GITHUB_ISSUE_URL>.
   * @todo Add GitHub Labels to the Rally Defect as Rally Tags.
   *
   * See @link https://rally1.rallydev.com/slm/doc/webservice/ Rally Web Services API documentation. @endlink
   * See @link https://developer.github.com/v3/activity/events/types/#issuesevent IssuesEvent Events API payload @endlink
   *
   * @see \GitHubToRally\Rally.
   */
  public function syncToRally() {
    if ('issues' == $this->handler->getEvent()) {
      $data = $this->handler->getData();
    }
  }

}
