# GitHubToRally

## Why?
If you feel that Github is for creativity, while Rally is for bureaucracy, this
 project can help.

## What?
When developers create issues in a linked GitHub project, GitHubToRally
 automatically triggers the following API actions:
 - Creates a Defect in your configured Rally project.
    - The thinking behind always creating defects is that in Rally, Defects
      can be converted to User Stories if needed (whereas GitHub doesn't
      differentiate between "feature requests", "bugs" or any other type of
      issue. In GitHub, those concepts and others are flexibly managed with
      Labels).
 - The GitHub issue description updates the Rally Defect description (and
   converts the GitHub flavored markdown to HTML for Rally's WYSIWYG).
 - Adds a comment to the Rally Defect's Discussion tab:
   > Join the discussion at: <GITHUB_ISSUE_URL>.
 - Adds GitHub Labels to the Rally Defect as Rally Tags.


## How?

### Environment setup
1. Your environment URL must be accessible (GitHub's API will call the URL you
   specify in the "GitHub integration" section below).
2. Set a `GITHUB_SECRET` environment variable. Please choose a
   [secure](https://developer.github.com/webhooks/securing/#setting-your-secret-token)
   secret.
3. Clone this project into the web root of your environment.
4. Run `composer update` to download projet dependencies, and generate
   composer's autoload file.
5. Create a `config.yml` file in the project root, containing your Rally
   settings. See `example.config.yml` for details.

### GitHub integration
1. Add a GitHub
   [Integration](https://developer.github.com/early-access/integrations/creating-an-integration/),
   or [Webhook](https://developer.github.com/webhooks/), according to your preference.
2. If you prefer to connect via a `Webhook`:
   - Set `Payload URL` as https://DOMAIN/github.php ()where DOMAIN is the
     domain where you installed this project (see "Environment setup" above).
   - Set `Secret` to the `GITHUB_SECRET` environment variable you added above.
   - For `events to trigger this webhook`, choose `Let me select individual
     events.`, and make sure only `Issues` is selected.
   - Ensure the webhook is `Active`.
   - Click `Add webhook`.
3. If you prefer to connect via an `Integration`:
   - To-Do: Add instructions for integrations.

## Future?
GitHubToRally could in the future also triggers additional API actions, such
 as:
 - Sync GitHub milestones to Rally Milestones (and keep the connections in sync
   between GitHub Issues/Milestones and Rally Defects/Milestones).
 - Find a way to tie GitHub's new Projects to Rally Projects.
