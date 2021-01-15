<?php namespace CheckEmail\Core\Request;

use CheckEmail\Core\Loadie;
use CheckEmail\Core\UI\Page\Check_Email_Log_List_Page;

/**
 * Actions performed in Log List.
 */
class Check_Email_Log_List_Action implements Loadie {

	public function load() {
		add_action( 'wp_ajax_check-email-log-list-view-message', array( $this, 'view_log_message' ) );

		add_action( 'check-email-log-list-delete', array( $this, 'delete_logs' ) );
		add_action( 'check-email-log-list-delete-all', array( $this, 'delete_all_logs' ) );
		add_action( 'check-email-log-list-manage-user-roles-changed', array( $this, 'update_capabilities_for_user_roles' ), 10, 2 );
	}

	public function view_log_message() {
		if ( ! current_user_can( 'manage_check_email' ) ) {
			wp_die();
		}

		$id = absint( $_GET['log_id'] );

		if ( $id <= 0 ) {
			wp_die();
		}

		$log_items = $this->get_table_manager()->fetch_log_items_by_id( array( $id ) );
		if ( count( $log_items ) > 0 ) {
			$log_item = $log_items[0];

			$headers = array();
			if ( ! empty( $log_item['headers'] ) ) {
				$parser  = new \CheckEmail\Util\Check_Email_Header_Parser();
				$headers = $parser->parse_headers( $log_item['headers'] );
			}

			$active_tab = '0';
			if ( isset( $headers['content_type'] ) && 'text/html' === $headers['content_type'] ) {
				$active_tab = '1';
			}

			ob_start();
			?>
			<table style="width: 100%;">
				<tr style="background: #eee;">
					<td style="padding: 5px;"><?php _e( 'Sent at', 'check-email' ); ?>:</td>
					<td style="padding: 5px;"><?php echo esc_html( $log_item['sent_date'] ); ?></td>
				</tr>
				<tr style="background: #eee;">
					<td style="padding: 5px;"><?php _e( 'To', 'check-email' ); ?>:</td>
					<td style="padding: 5px;"><?php echo esc_html( $log_item['to_email'] ); ?></td>
				</tr>
				<tr style="background: #eee;">
					<td style="padding: 5px;"><?php _e( 'Subject', 'check-email' ); ?>:</td>
					<td style="padding: 5px;"><?php echo esc_html( $log_item['subject'] ); ?></td>
				</tr>

				<?php
                                    do_action( 'check_email_view_log_after_headers', $log_item );
				?>

			</table>

			<div id="tabs">
				<ul data-active-tab="<?php echo absint( $active_tab ); ?>">
					<li><a href="#tabs-text"><?php _e( 'Raw Email Content', 'check-email' ); ?></a></li>
					<li><a href="#tabs-preview"><?php _e( 'Preview Content as HTML', 'check-email' ); ?></a></li>
				</ul>

				<div id="tabs-text">
					<pre class="tabs-text-pre"><?php echo esc_textarea( $log_item['message'] ); ?></pre>
				</div>

				<div id="tabs-preview">
					<?php echo wp_kses( $log_item['message'], $this->check_email_kses_allowed_html( 'post' ) ); ?>
				</div>
			</div>

			<div id="view-message-footer">
				<a href="#" class="button action" id="thickbox-footer-close"><?php _e( 'Close', 'check-email' ); ?></a>
			</div>

			<?php
			echo ob_get_clean();
		}

		wp_die(); // this is required to return a proper result.
	}

	public function delete_logs( $data ) {
		if ( ! is_array( $data ) || ! array_key_exists( 'check-email-log', $data ) ) {
			return;
		}

		$ids = $data['check-email-log'];
		if ( ! is_array( $ids ) ) {
			$ids = array( $ids );
		}

		$ids     = array_map( 'absint', $ids );
		$id_list = implode( ',', $ids );

		$logs_deleted = $this->get_table_manager()->delete_logs( $id_list );
		$this->render_log_deleted_notice( $logs_deleted );
	}

	public function delete_all_logs() {
		$logs_deleted = $this->get_table_manager()->delete_all_logs();
		$this->render_log_deleted_notice( $logs_deleted );
	}

	public function update_capabilities_for_user_roles( $old_roles, $new_roles ) {
		foreach ( $old_roles as $old_role ) {
			$role = get_role( $old_role );

			if ( ! is_null( $role ) ) {
				$role->remove_cap( Check_Email_Log_List_Page::CAPABILITY );
			}
		}

		foreach ( $new_roles as $new_role ) {
			$role = get_role( $new_role );

			if ( ! is_null( $role ) ) {
				$role->add_cap( Check_Email_Log_List_Page::CAPABILITY );
			}
		}
	}

	protected function render_log_deleted_notice( $logs_deleted ) {
		$message = __( 'There was some problem in deleting the email logs', 'check-email' );
		$type    = 'error';

		if ( absint( $logs_deleted ) > 0 ) {
			$message = sprintf( _n( '1 email log deleted.', '%s email logs deleted', $logs_deleted, 'check-email' ), $logs_deleted );
			$type    = 'updated';
		}

		add_settings_error(
			'log-list',
			'deleted-check-email-logs',
			$message,
			$type
		);
	}

	protected function get_table_manager() {
		$check_email = check_email();

		return $check_email->table_manager;
	}

	protected function check_email_kses_allowed_html( $context = 'post' ) {
		$allowed_tags = wp_kses_allowed_html( $context );

		$allowed_tags['link'] = array(
			'rel'   => true,
			'href'  => true,
			'type'  => true,
			'media' => true,
		);

		return $allowed_tags;
	}
}
