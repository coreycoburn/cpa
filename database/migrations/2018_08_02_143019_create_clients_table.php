<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.4.1)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recurring_client_id')->nullable();
            $table->integer('recurring')->default(0);
            $table->char('address_contact', 1)->default('1');
            $table->char('attn_to', 3)->default('No');
            $table->string('fname', 50)->nullable();
            $table->string('lname', 50)->nullable();
            $table->string('company', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('bus_num', 50)->nullable();
            $table->string('other_num', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('email1_option', 5)->default('to');
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->string('fname2', 50)->nullable();
            $table->string('lname2', 50)->nullable();
            $table->string('company2', 50)->nullable();
            $table->string('email2', 50)->nullable();
            $table->string('email2_option', 5)->default('cc');
            $table->string('phone2', 50)->nullable();
            $table->string('fax2', 50)->nullable();
            $table->string('bus_num2', 50)->nullable();
            $table->string('other_num2', 50)->nullable();
            $table->string('contact_address', 50)->nullable();
            $table->string('contact_city', 50)->nullable();
            $table->string('contact_state', 20)->nullable();
            $table->string('contact_zip', 100)->nullable();
            $table->string('referral', 50)->nullable();
            $table->string('contact_method', 20)->nullable();
            $table->string('service_type', 20)->nullable();
            $table->string('event_type', 100)->nullable();
            $table->string('location_type', 100)->nullable();
            $table->string('location_name', 100)->nullable();
            $table->string('location_field_name', 100)->default('Event');
            $table->string('month', 20)->nullable();
            $table->string('day', 20)->nullable();
            $table->string('year', 20)->nullable();
            $table->date('event_date')->nullable()->default('0000-00-00');
            $table->string('guest_ready', 20)->nullable();
            $table->string('start_advertised', 20)->nullable();
            $table->string('start', 20)->nullable();
            $table->string('end', 20)->nullable();
            $table->string('guests', 100)->nullable();
            $table->string('event_address', 50)->nullable();
            $table->string('event_city', 50)->nullable();
            $table->string('event_state', 20)->nullable();
            $table->string('event_zip', 100)->nullable();
            $table->decimal('event_longitude', 11, 7)->nullable();
            $table->decimal('event_latitude', 11, 7)->nullable();
            $table->string('billing_address', 50)->nullable();
            $table->string('billing_city', 50)->nullable();
            $table->string('billing_state', 20)->nullable();
            $table->string('billing_zip', 100)->nullable();
            $table->string('billing_fax', 50)->nullable();
            $table->string('billing_company', 50)->default('');
            $table->string('billing_fname', 50)->default('');
            $table->string('billing_lname', 50)->default('');
            $table->string('billing_email', 50)->default('');
            $table->string('billing_phone', 50)->default('');
            $table->string('billing_cell', 50)->default('');
            $table->string('billing_other', 50)->default('');
            $table->text('billing_desc')->nullable();
            $table->text('message')->nullable();
            $table->text('cpa_message')->nullable();
            $table->text('manager_message')->nullable();
            $table->text('all_emp_message')->nullable();
            $table->text('client_message')->nullable();
            $table->integer('prepared_by')->nullable();
            $table->integer('changes_by')->nullable();
            $table->dateTime('update_time')->nullable();
            $table->integer('questions')->nullable();
            $table->dateTime('submitted');
            $table->text('emp_num_array')->nullable();
            $table->text('emp_type_array')->nullable();
            $table->text('start_time_array')->nullable();
            $table->text('end_time_array')->nullable();
            $table->text('min_opt_out_array')->nullable();
            $table->text('minimum_alert_array')->nullable();
            $table->text('total_time_array')->nullable();
            $table->text('valet_total_array')->nullable();
            $table->string('start_time1', 5)->nullable();
            $table->string('end_time1', 5)->nullable();
            $table->string('emp_num1', 10)->nullable();
            $table->string('emp_type1', 20)->nullable();
            $table->string('start_time2', 5)->nullable();
            $table->string('end_time2', 5)->nullable();
            $table->string('emp_num2', 10)->nullable();
            $table->string('emp_type2', 20)->nullable();
            $table->string('start_time3', 5)->nullable();
            $table->string('end_time3', 5)->nullable();
            $table->string('emp_num3', 10)->nullable();
            $table->string('emp_type3', 20)->nullable();
            $table->string('start_time4', 5)->nullable();
            $table->string('end_time4', 5)->nullable();
            $table->string('emp_num4', 10)->nullable();
            $table->string('emp_type4', 20)->nullable();
            $table->string('start_time5', 5)->nullable();
            $table->string('end_time5', 5)->nullable();
            $table->string('emp_num5', 10)->nullable();
            $table->string('emp_type5', 20)->nullable();
            $table->string('valet_rate', 10)->nullable()->default('42');
            $table->string('director_rate', 10)->nullable()->default('42');
            $table->string('driver_rate', 10)->nullable()->default('42');
            $table->string('manager_rate', 10)->nullable()->default('42');
            $table->string('travel_fee', 10)->nullable()->default('0');
            $table->string('travel_fee_total', 10)->nullable();
            $table->string('travel_fee_contract', 10)->nullable()->default('10');
            $table->tinyInteger('omit_travel')->nullable()->default(0);
            $table->enum('omit_rate_display', ['0', '1'])->default(0);
            $table->string('seven_pass_van_num', 10)->nullable();
            $table->string('twelve_pass_van_num', 10)->nullable();
            $table->string('four_pass_cart_num', 10)->nullable();
            $table->string('six_pass_cart_num', 10)->nullable();
            $table->float('bus1_num')->nullable();
            $table->float('bus2_num')->nullable();
            $table->float('bus3_num')->nullable();
            $table->string('seven_pass_van_rate', 10)->nullable();
            $table->string('twelve_pass_van_rate', 10)->nullable();
            $table->string('four_pass_cart_rate', 10)->nullable();
            $table->string('six_pass_cart_rate', 10)->nullable();
            $table->float('bus1_rate')->nullable();
            $table->float('bus2_rate')->nullable();
            $table->float('bus3_rate')->nullable();
            $table->string('seven_pass_van_total', 10)->nullable();
            $table->string('twelve_pass_van_total', 10)->nullable();
            $table->string('four_pass_cart_total', 10)->nullable();
            $table->string('six_pass_cart_total', 10)->nullable();
            $table->float('bus1_total')->nullable();
            $table->float('bus2_total')->nullable();
            $table->float('bus3_total')->nullable();
            $table->float('bus1_hours')->nullable();
            $table->float('bus2_hours')->nullable();
            $table->float('bus3_hours')->nullable();
            $table->string('bus1_type', 50)->nullable();
            $table->string('bus2_type', 50)->nullable();
            $table->string('bus3_type', 50)->nullable();
            $table->float('bus1_start')->nullable();
            $table->float('bus1_end')->nullable();
            $table->float('bus2_start')->nullable();
            $table->float('bus2_end')->nullable();
            $table->float('bus3_start')->nullable();
            $table->float('bus3_end')->nullable();
            $table->text('bus_asterik')->nullable();
            $table->string('bag_meter', 10)->nullable();
            $table->string('shuttle_fee', 10)->nullable();
            $table->string('estimated_total', 10)->nullable();
            $table->string('insurance_fee', 10)->nullable();
            $table->integer('service_charge')->nullable()->default(0);
            $table->string('service_charge_estimate', 10)->nullable();
            $table->string('gratuity', 10)->nullable();
            $table->string('gratuity_num', 10)->nullable();
            $table->string('gratuity_num2', 10)->nullable();
            $table->integer('gratuity_num3')->default(0);
            $table->enum('add_gratuity_later', ['0', '1'])->default(0);
            $table->enum('override_gratuity', ['0', '1'])->nullable()->default(0);
            $table->string('van_pickup', 10)->nullable();
            $table->float('shuttle_pickup_fee')->nullable();
            $table->string('shuttle_pickup_fee_desc', 75)->nullable();
            $table->string('hour_minimum', 100)->default('4');
            $table->string('reduce_minimum', 10)->nullable();
            $table->string('total_time1', 10)->nullable();
            $table->string('minimum_alert1', 10)->nullable();
            $table->string('total_time2', 10)->nullable();
            $table->string('minimum_alert2', 10)->nullable();
            $table->string('total_time3', 10)->nullable();
            $table->string('minimum_alert3', 10)->nullable();
            $table->string('total_time4', 10)->nullable();
            $table->string('minimum_alert4', 10)->nullable();
            $table->string('total_time5', 10)->nullable();
            $table->string('minimum_alert5', 10)->nullable();
            $table->string('total_time', 10)->nullable();
            $table->string('cars', 50)->nullable();
            $table->string('valet_total1', 10)->nullable();
            $table->string('valet_total2', 10)->nullable();
            $table->string('valet_total3', 10)->nullable();
            $table->string('valet_total4', 10)->nullable();
            $table->string('valet_total5', 10)->nullable();
            $table->string('valet_total', 10)->nullable();
            $table->date('proposal_due_date')->nullable();
            $table->date('confirmation_due_date')->nullable();
            $table->date('revision_due_date')->nullable();
            $table->date('contract_date')->nullable();
            $table->string('contract_type', 20)->nullable();
            $table->dateTime('contract_time')->nullable();
            $table->string('social_title', 10)->nullable();
            $table->text('special_requests')->nullable();
            $table->string('rate_type', 50)->nullable()->default('standard rate');
            $table->string('rate_type_amount', 10)->nullable()->default('48');
            $table->string('cleaning_fee', 10)->nullable();
            $table->integer('deposit_due')->nullable()->default(0);
            $table->date('dep1_due_date')->nullable();
            $table->string('dep1_amt_due', 10)->nullable();
            $table->string('manual_deposit', 10)->nullable();
            $table->date('dep1_recv_date')->nullable();
            $table->string('dep1_amt_recv', 10)->nullable();
            $table->string('dep1_check_num', 10)->nullable();
            $table->text('dep1_notes')->nullable();
            $table->date('dep2_due_date')->nullable();
            $table->string('dep2_amt_due', 10)->nullable();
            $table->date('dep2_recv_date')->nullable();
            $table->string('dep2_amt_recv', 10)->nullable();
            $table->string('dep2_check_num', 10)->nullable();
            $table->date('bal_due_date')->nullable();
            $table->string('bal_amt_due', 10)->nullable();
            $table->date('bal_recv_date')->nullable();
            $table->string('bal_amt_recv', 10)->nullable();
            $table->string('bal_check_num', 10)->nullable();
            $table->string('unpaid', 10)->nullable();
            $table->string('unpaid_reason', 100)->nullable();
            $table->integer('contract_prepared_by')->nullable();
            $table->string('cancellation_policy', 20)->nullable();
            $table->string('font_size', 10)->nullable()->default('12');
            $table->string('top_margin', 10)->default('40');
            $table->string('cc_patrick', 5)->default('no');
            $table->string('cc_soraya', 5)->nullable()->default('no');
            $table->string('contract_sent', 5)->nullable()->default('no');
            $table->dateTime('contract_sent_time')->nullable()->default('0000-00-00 00:00:00');
            $table->string('contract_sent_type', 50)->nullable()->default('no');
            $table->string('deposit_type', 20)->default('check');
            $table->string('book_client', 10)->default('no');
            $table->dateTime('book_client_time')->nullable();
            $table->text('td_notes')->nullable();
            $table->date('client_due_date')->nullable();
            $table->string('client_due_time', 50)->nullable();
            $table->string('misc_rate1_name', 50)->default('');
            $table->string('misc_rate1_amt', 50)->default('');
            $table->string('misc_rate2_name', 50)->default('');
            $table->string('misc_rate2_amt', 50)->default('');
            $table->date('revision_date')->nullable();
            $table->text('revision_text')->nullable();
            $table->text('re_text')->nullable();
            $table->string('service_valet', 20)->nullable();
            $table->string('service_direction', 20)->nullable();
            $table->string('service_shuttle', 20)->nullable();
            $table->string('service_fixed', 20)->nullable();
            $table->string('service_coordination', 20)->nullable();
            $table->string('flat_rate', 20)->nullable();
            $table->string('flat_rate_time', 20)->nullable();
            $table->char('col_cost', 2)->default('8');
            $table->text('misc1_asterik')->nullable();
            $table->text('misc2_asterik')->nullable();
            $table->string('client_list', 10)->nullable();
            $table->tinyInteger('extra_services')->default(0);
            $table->tinyInteger('email_thankyou')->default(0);
            $table->string('deposit_complete', 4)->default('no');
            $table->string('event_info_title1', 50)->nullable();
            $table->string('event_info_title2', 50)->nullable();
            $table->string('event_info_title3', 50)->nullable();
            $table->string('event_info_title4', 50)->nullable();
            $table->text('event_info_desc1')->nullable();
            $table->text('event_info_desc2')->nullable();
            $table->text('event_info_desc3')->nullable();
            $table->text('event_info_desc4')->nullable();
            $table->tinyInteger('min_opt_out1')->default(0);
            $table->tinyInteger('min_opt_out2')->default(0);
            $table->tinyInteger('min_opt_out3')->default(0);
            $table->tinyInteger('min_opt_out4')->default(0);
            $table->tinyInteger('min_opt_out5')->default(0);
            $table->tinyInteger('deposit_day_of')->default(0);
            $table->char('omit_description', 1)->default('0');
            $table->char('omit_gratuity', 1)->default('0');
            $table->char('add_all_gratuity_fees', 1)->default('0');
            $table->float('bus4_num')->nullable();
            $table->float('bus5_num')->nullable();
            $table->float('bus6_num')->nullable();
            $table->float('bus7_num')->nullable();
            $table->float('bus8_num')->nullable();
            $table->float('bus9_num')->nullable();
            $table->float('bus10_num')->nullable();
            $table->string('bus4_type', 50)->nullable();
            $table->string('bus5_type', 50)->nullable();
            $table->string('bus6_type', 50)->nullable();
            $table->string('bus7_type', 50)->nullable();
            $table->string('bus8_type', 50)->nullable();
            $table->string('bus9_type', 50)->nullable();
            $table->string('bus10_type', 50)->nullable();
            $table->float('bus4_start')->nullable();
            $table->float('bus5_start')->nullable();
            $table->float('bus6_start')->nullable();
            $table->float('bus7_start')->nullable();
            $table->float('bus8_start')->nullable();
            $table->float('bus9_start')->nullable();
            $table->float('bus10_start')->nullable();
            $table->float('bus4_end')->nullable();
            $table->float('bus5_end')->nullable();
            $table->float('bus6_end')->nullable();
            $table->float('bus7_end')->nullable();
            $table->float('bus8_end')->nullable();
            $table->float('bus9_end')->nullable();
            $table->float('bus10_end')->nullable();
            $table->float('bus4_rate')->nullable();
            $table->float('bus5_rate')->nullable();
            $table->float('bus6_rate')->nullable();
            $table->float('bus7_rate')->nullable();
            $table->float('bus8_rate')->nullable();
            $table->float('bus9_rate')->nullable();
            $table->float('bus10_rate')->nullable();
            $table->float('bus4_total')->nullable();
            $table->float('bus5_total')->nullable();
            $table->float('bus6_total')->nullable();
            $table->float('bus7_total')->nullable();
            $table->float('bus8_total')->nullable();
            $table->float('bus9_total')->nullable();
            $table->float('bus10_total')->nullable();
            $table->float('bus4_hours')->nullable();
            $table->float('bus5_hours')->nullable();
            $table->float('bus6_hours')->nullable();
            $table->float('bus7_hours')->nullable();
            $table->float('bus8_hours')->nullable();
            $table->float('bus9_hours')->nullable();
            $table->float('bus10_hours')->nullable();
            $table->string('shuttle_pickup_loc', 50)->default('');
            $table->text('shuttle_pickup_desc')->nullable();
            $table->string('colwidth', 50)->default('54~35~57~46');
            $table->integer('add_address')->default(0);
            $table->string('contract_number', 50)->nullable();
            $table->enum('no_more_deposits', ['0', '1'])->default(0);
            $table->string('manager', 5)->default('');
            $table->enum('email_manager', ['0', '1'])->default(0);
            $table->string('manager_activation', 40)->default('');
            $table->enum('confirm_details', ['0', '1', '2'])->default(0);
            $table->dateTime('confirm_details_time')->default('0000-00-00 00:00:00');
            $table->integer('vehicle_flat_num_misc1')->nullable();
            $table->string('vehicle_flat_desc_misc1', 50)->nullable();
            $table->string('vehicle_flat_type_misc1', 10)->nullable();
            $table->float('vehicle_flat_rate_misc1')->nullable();
            $table->float('vehicle_flat_total_misc1')->nullable();
            $table->integer('vehicle_flat_num_misc2')->nullable();
            $table->string('vehicle_flat_desc_misc2', 50)->nullable();
            $table->string('vehicle_flat_type_misc2', 10)->nullable();
            $table->float('vehicle_flat_rate_misc2')->nullable();
            $table->float('vehicle_flat_total_misc2')->nullable();
            $table->text('contract_notes')->nullable();
            $table->date('follow_up')->nullable();
            $table->enum('follow_up_complete', ['0', '1'])->nullable();
            $table->text('emp_asterik')->nullable();
            $table->enum('quote_from_internet', ['0', '1'])->nullable()->default(0);
            $table->enum('annual_event', ['0', '1'])->nullable()->default(0);
            $table->date('annual_reminder_date')->default('0000-00-00');
            $table->enum('annual_event_email_sent', ['0', '1', '2'])->nullable()->default(0);
            $table->enum('send_deposit_received_email', ['0', '1'])->nullable()->default(1);
            $table->dateTime('todo')->nullable();





        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
