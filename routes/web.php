<?php
// ADMIN - CONTROLLERS
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentCommissionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\UploadFormsController;
use App\Http\Controllers\LogHistoryController;
use App\Http\Controllers\SpecialAnnouncementsControllers;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\FundforFunController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\AuthorityToSellController;
use App\Http\Controllers\MarketingMaterialsController;
use App\Http\Controllers\SalesTeamStatistics;
use App\Http\Controllers\BirthdayCelebrantsController;
use App\Http\Controllers\FilterSalesController;
use App\Http\Controllers\SalesLocationController;
use App\Http\Controllers\SalesValidationController;
use App\Http\Controllers\TrainingVideosController;
use App\Http\Controllers\TeamTopControllers;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MonthlyPosterController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MemberNatconController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\BrokerageController;
use App\Http\Controllers\UplineRequestController;
use App\Http\Controllers\TeamEventsController;
use App\Http\Controllers\AdsManagementController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\DeveloperSalesController;
use App\Http\Controllers\TypeaheadController;
use App\Http\Controllers\SalesTeamController;
use App\Http\Controllers\PresentationsController;
use App\Http\Controllers\Inactive\InactiveProjectsController;
use App\Http\Controllers\Inactive\InactiveDeveloperController;
use App\Http\Controllers\HeatmapController;
use App\Http\Controllers\GoalSettingController;
use App\Http\Controllers\SalesTeamSubTeamController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\DeveloperAndProjectsController;
use App\Http\Controllers\AppSupportController;
use App\Http\Controllers\WebAuthController;

// AGENT - CONTROLLERS
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\AgentDeveloperController;
use App\Http\Controllers\Agent\AgentMarketingMaterialsController;
use App\Http\Controllers\Agent\AgentMemberController;
use App\Http\Controllers\Agent\AgentOfficesController;
use App\Http\Controllers\Agent\AgentProjectsController;
use App\Http\Controllers\Agent\AgentSalesReportController;
use App\Http\Controllers\Agent\AgentTrainingVideosController;
use App\Http\Controllers\Agent\AgentUploadFormsController;
use App\Http\Controllers\API\MailerController;
use App\Http\Controllers\API\MemberController as APIMemberController;
use App\Http\Controllers\API\SalesRequestController as APISalesRequestController;
use App\Http\Controllers\Secretary\SecretaryCommissionController;
use App\Http\Controllers\Agent\AgentCommentsController;
// SUPERVISOR - CONTROLLERS
use App\Http\Controllers\Supervisor\SupervisorCommissionController;
use App\Http\Controllers\Supervisor\SupervisorDashboardController;
use App\Http\Controllers\Supervisor\SupervisorDeveloperController;
use App\Http\Controllers\Supervisor\SupervisorMarketingMaterialsController;
use App\Http\Controllers\Supervisor\SupervisorMemberController;
use App\Http\Controllers\Supervisor\SupervisorOfficesController;
use App\Http\Controllers\Supervisor\SupervisorProjectsController;
use App\Http\Controllers\Supervisor\SupervisorSalesReportController;
use App\Http\Controllers\Supervisor\SupervisorSalesTeamStatistics;
use App\Http\Controllers\Supervisor\SupervisorTLDashboardController;
use App\Http\Controllers\Supervisor\SupervisorTrainingVideosController;
use App\Http\Controllers\Supervisor\SupervisorUploadFormsController;
use App\Http\Controllers\Supervisor\SupervisorTeamEventsController;

// SECRETARY - CONTROLLERS
use App\Http\Controllers\Secretary\SecretaryDashboardController;
use App\Http\Controllers\Secretary\SecretaryDeveloperController;
use App\Http\Controllers\Secretary\SecretaryMemberController;
use App\Http\Controllers\Secretary\SecretaryProjectsController;
use App\Http\Controllers\Secretary\SecretarySalesReportController;
use App\Http\Controllers\Secretary\SecretaryUploadFormsController;


// EDITOR - CONTROLLERS

use App\Http\Controllers\Editor\EditorDashboarddController;
use App\Http\Controllers\Inactive\InactiveCommentsController;
use App\Http\Controllers\Inactive\InactiveDashboardController;
use App\Http\Controllers\Inactive\InactiveMemberController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Secretary\SecretaryOfficesController;
use App\Http\Controllers\Secretary\SecretarySalesValidationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Supervisor\SupervisorCommentsController;


// UNIT MANAGER - CONTROLLERS
use App\Http\Controllers\UnitManager\UnitManagerCommentsController;
use App\Http\Controllers\UnitManager\UnitManagerCommissionController;
use App\Http\Controllers\UnitManager\UnitManagerProjectsController;
use App\Http\Controllers\UnitManager\UnitManagerDashboardController;
use App\Http\Controllers\UnitManager\UnitManagerDeveloperController;
use App\Http\Controllers\UnitManager\UnitManagerMarketingMaterialsController;
use App\Http\Controllers\UnitManager\UnitManagerMemberController;
use App\Http\Controllers\UnitManager\UnitManagerOfficesController;
use App\Http\Controllers\UnitManager\UnitManagerSalesReportController;
use App\Http\Controllers\UnitManager\UnitManagerSalesTeamStatistics;
use App\Http\Controllers\UnitManager\UnitManagerTLDashboardController;
use App\Http\Controllers\UnitManager\UnitManagerTrainingVideosController;
use App\Http\Controllers\UnitManager\UnitManagerUploadFormsController;

// RENTAL -- CONTROLLERS
use App\Http\Controllers\Rent\RentalController;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */

Route::middleware('disabled.maintenance')->group(function () {

    Route::middleware('frameguard')->group(function () {
        // QR Download File 
        Route::get('files', [HomeController::class, 'qrDownload'])->name('qrDownload');
        // --- LR PAGES ---
        Route::get('login', [MemberAuthController::class, 'index'])->name('login');

        Route::get('registration', [MemberAuthController::class, 'registration'])->name('register-user');

        Route::get('realty-form', [MemberAuthController::class, 'brokerage_acc_form'])->name('realty-reg-form');

        Route::get('signout', [MemberAuthController::class, 'signOut'])->name('signout');

        Route::post('listcities', [MemberAuthController::class, 'listcities'])->name('list.city.fetch');

        Route::get('welcome', [MemberAuthController::class, 'welcome'])->name('welcome');

        Route::get('sendmail', [MemberAuthController::class, 'sendMail'])->name('sendmail');

        Route::get('/', [HomeController::class, 'index'])->name('lr-home');

        Route::get('/projects-map-update', [HomeController::class, 'projects_heatmap'])->name('lr-project-heatmap');

        Route::post('/project-update-map', [HomeController::class, 'update_map'])->name('lr-project-update-map');

        Route::get('/about', [AboutController::class, 'index'])->name('lr-about');

        Route::get('/lr-frame/{title}', [FrameController::class, 'index'])->name('lr-frame');

        Route::get('/event/certificate/{certificateevent}', [AboutController::class, 'certificate_event'])->name('lr-certificate-event-downloader');

        Route::post('/dashboard/event/certificate/generate', [CertificateController::class, 'generate_certificate_event'])->name('lr-certificate-event-generate');

        Route::get('/offices', [OfficesController::class, 'index'])->name('lr-offices');

        Route::get('/offices-map-locations', [OfficesController::class, 'office_map_location'])->name('lr-offices-map-location');

        Route::get('/contact', [ContactController::class, 'index'])->name('lr-contact');

        Route::post('/send-inquiry-email', [ContactController::class, 'send_inquiry'])->name('lr-send-inquiry-email');

        Route::get('/contact/{memberid}/{member_name}', [ContactController::class, 'contact_person'])->name('lr-contact-person');

        Route::get('/forgot-password', [MemberAuthController::class, 'forgot_password'])->name('lr-forgot-password');

        Route::get('/cities/{province_id}', [MemberAuthController::class, 'fetch_cities'])->name('lr-fetch-cities');

        Route::get('/realty-verification/{token}', [MemberAuthController::class, 'realty_email_verification'])->name('realty-verification');

        Route::get('/dashboard/qr-code-poster', [PosterController::class, 'qr_poster'])->name('lr-qr-code-poster');

        Route::get('/MQpEHf0gAu', [MailerController::class, 'request_password_reset']);

        Route::get('/developer-sales-revalidation/{sale_id}/{token}', [DeveloperSalesController::class, 'review_client_requirements'])->name('lr-developer-sales-revalidation');

        Route::get('/birthday/search-member/{member}', [TypeaheadController::class, 'autocompleteSearch'])->name('lr-birthday-search-member');

        Route::get('/birthday/get-member-data/{memberid}', [TypeaheadController::class, 'autocompleteSearchMemberID'])->name('lr-birthday-search-member-id');

        Route::get('/create-email-token', [APIMemberController::class, 'generate_email_token']);

        Route::get('/dashboard/materials/logo', [MarketingMaterialsController::class, 'logo_materials'])->name('lr-materials');

        Route::get('/dashboard/training-videos', [TrainingVideosController::class, 'index'])->name('lr-training-videos');

        Route::get('/dashboard/qr-poster-maker', [TrainingVideosController::class, 'qr_poster'])->name('lr-qr-poster-maker');

        Route::get('/lr-teams', [APIMemberController::class, 'api_request_teams']);

        Route::get('/developer-and-projects', [DeveloperAndProjectsController::class, 'index'])->name('lr-developer-and-projects');

        Route::get('/get-developers', [DeveloperAndProjectsController::class, 'get_developers'])->name('lr-get-developer');

        Route::get('/get-projects', [DeveloperAndProjectsController::class, 'get_projects'])->name('lr-get-projects');

        Route::post('/developers/assign-long-lat', [DeveloperAndProjectsController::class, 'assign_long_lat_developers'])->name('lr-update-developer-long-lat');

        Route::post('/projects/assign-long-lat', [DeveloperAndProjectsController::class, 'assign_long_lat_projects'])->name('lr-update-projects-long-lat');

        Route::get('/developer-and-projects/search-developer/', [DeveloperAndProjectsController::class, 'search_developer_name'])->name('lr-search-developer-name');

        Route::get('/developer-and-projects/search-developer-by-area/', [DeveloperAndProjectsController::class, 'search_developer_by_area'])->name('lr-search-developer-by-area');

        Route::get('/developer-and-projects/search-project/', [DeveloperAndProjectsController::class, 'search_project_name'])->name('lr-search-project-name');

        Route::get('/developer-and-projects/search-project-by-area/', [DeveloperAndProjectsController::class, 'search_project_by_area'])->name('lr-search-project-by-area');

        Route::get('/developer-and-projects/search-project-by-category/', [DeveloperAndProjectsController::class, 'search_project_by_category'])->name('lr-search-project-by-category');

        Route::get('/registration/v2', [MemberAuthController::class, 'registrationV2']);

        Route::get('v1/authentication', [WebAuthController::class, 'index']);

        Route::middleware('lr.api')->group(function () {
            Route::get('/rfid-search-an-agent-data', [APIMemberController::class, 'api_agent_searches_data']);

            Route::get('/request-team-members', [APIMemberController::class, 'api_request_team_members']);

            Route::get('/natcon-qualifiers', [APIMemberController::class, 'get_natcon_qualifiers']);

            Route::middleware('xss')->group(function () {
                Route::post('/update-split-comm-request', [APISalesRequestController::class, 'update_split_comm_request']);
            });
        });

        Route::middleware('xss')->group(function () {

            Route::post('/auth/login', [MemberAuthController::class, 'auth_login'])->name('auth-login');

            Route::get('realty-form/{token}', [MemberAuthController::class, 'brokerage_acc_form'])->name('realty-reg-form-verified');

            Route::get('/request-verification', [MemberAuthController::class, 'request_verification'])->name('request-verification');

            Route::middleware('xss')->group(function () {

                Route::post('/add-sales-goals', [GoalSettingController::class, 'add_sales_goals'])->name('lr-add-sales-goals');

                Route::post('/auth/login', [MemberAuthController::class, 'auth_login'])->name('auth-login');

                Route::post('/auth/verify-email', [MemberAuthController::class, 'request_password_reset'])->name('auth-verify-email');

                Route::post('/auth/submit-new-password', [MemberAuthController::class, 'submit_new_password'])->name('auth-submit-new-password');

                Route::post('/auth/password-reset/submit-code', [MemberAuthController::class, 'submit_password_reset_code'])->name('auth-password-reset-code');

                Route::get('/auth/create-new-password', [MemberAuthController::class, 'create_new_password'])->name('lr-create-new-password');

                Route::post('/custom-registration', [MemberAuthController::class, 'customRegistration'])->name('register.custom');

                Route::post('/send-message', [ContactController::class, 'send_message'])->name('send-message');

                Route::post('/realty-form-update', [MemberAuthController::class, 'update_brokerage_acc_form'])->name('realty-form-update');

                Route::post('/realty-form-submit', [MemberAuthController::class, 'submit_brokerage_acc_files'])->name('realty-form-submit');

                Route::post('/change-profile-pic', [MemberAuthController::class, 'changeprofile'])->name('lr-change-profile-pic');

                Route::post('/edit-profile-pic', [MemberAuthController::class, 'editimgprofile'])->name('lr-edited-profile-pic');

                Route::post('/add-comments', [CommentsController::class, 'add_comments'])->name('lr-comments-add');

                Route::get('/dashboard/pks_office/{office}', [PosterController::class, 'get_developers_by_office'])->name('lr-pks-maker-office');

                Route::get('/dashboard/pks_dev/{devid}', [PosterController::class, 'get_dev_data'])->name('lr-pks-maker-developer');

                Route::get('/certificate/type-and-category/{designtype}/{designcategory}', [CertificateController::class, 'filter_certificate'])->name('lr-filter-certificate-template');

                Route::post('/activity_logs/{memberid}', [ActivityLogsController::class, 'activity_logger'])->name('lr-activity-logger-text');
            });

            // LR - ADMIN ROLE DASHBOARD ---
            Route::middleware('auth.admin')->group(function () {

                Route::middleware('auth.settings')->group(function () {

                    Route::get('/mobile-app-support', [AppSupportController::class, 'index'])->name('lr-app-support');

                    Route::get('/dashboard/settings', [SettingsController::class, 'index'])->name('lr-settings');

                    Route::get('/get-settings', [SettingsController::class, 'get_settings'])->name('lr-get-settings');

                    Route::get('/dashboard/developer-statistics', [DeveloperController::class, 'developer_statistics'])->name('lr-developer-statistics');

                    Route::get('/dashboard/developer-statistics/{dev_id}', [DeveloperController::class, 'developer_statistics_data'])->name('lr-developer-statistics-data');

                    Route::get('/dashboard/team-statistics', [SalesTeamStatistics::class, 'index'])->name('lr-sales-team-statistics');

                    Route::get('/dashboard/team-recruits', [SalesTeamStatistics::class, 'team_recruits'])->name('lr-team-recruits');

                    Route::get('/dashboard/heatmap/members', [HeatmapController::class, 'index'])->name('lr-heatmap');

                    Route::get('/dashboard/heatmap/members-data', [HeatmapController::class, 'heatmap_data'])->name('lr-heatmap-members-data');

                    Route::get('/dashboard/activity-logs/members', [ActivityLogsController::class, 'viewer'])->name('lr-activity-logs-viewer');

                    Route::get('/dashboard/activity-logs/members-data', [ActivityLogsController::class, 'get_activities'])->name('lr-activity-logs-viewer-data');

                    Route::get('/dashboard/filter-sales/{category}', [FilterSalesController::class, 'index'])->name('lr-filter-sales');

                    Route::get('/dashboard/filter-sales/category/{category}', [FilterSalesController::class, 'get_developers_total_sales'])->name('lr-filter-sales-category');

                    Route::get('/rental-statistics', [RentalController::class, 'statistics'])->name('lr-rental-statistics');

                    Route::get('/lr-subteam-recruits', [SalesTeamSubTeamController::class, 'salesTeamSubTeamRecruits'])->name('subteam-recruits-statistics');

                    Route::get('/tl-recruits', [MemberController::class, 'membersWithDownlineCount'])->name('tl-recruits-statistics');

                    Route::middleware('xss')->group(function () {

                        Route::post('/update-cutoff-sales', [SettingsController::class, 'update_cutoff_sales'])->name('lr-update-cutoff-sales');

                        Route::post('/update-maintenance', [SettingsController::class, 'update_maintenance'])->name('lr-update-system-maintenance');

                        Route::post('/update-allow-universal-password', [SettingsController::class, 'update_allow_universal_password'])->name('lr-update-allow-universal-password');

                        Route::post('/update-allow-encode-sales', [SettingsController::class, 'update_allow_encode_sales'])->name('lr-update-allow-encode-sales');

                        Route::post('/update-universal-password', [SettingsController::class, 'update_universal_password'])->name('lr-update-universal-password');

                        Route::post('/update-expiration-account', [SettingsController::class, 'update_expiration_account'])->name('lr-update-expiration-account');
                    });
                });

                Route::middleware('auth.staff')->group(function () {

                    Route::get('/dashboard/teams', [SalesTeamStatistics::class, 'sales_teams'])->name('lr-sales-teams');

                    Route::get('/dashboard/teams-data', [SalesTeamStatistics::class, 'sales_team_data'])->name('lr-sales-teams-data');

                    Route::get('/dashboard/get-salesteam', [SalesTeamStatistics::class, 'get_sales_team'])->name('lr-get-sales-teams');

                    Route::get('/dashboard/get-members', [SalesTeamStatistics::class, 'get_members'])->name('lr-get-members');

                    Route::get('/dashboard/comments', [CommentsController::class, 'index'])->name('lr-comments');

                    Route::get('/developer/sales', [DeveloperController::class, 'developer_sales'])->name('lr-developer-sales');

                    Route::get('/dashboard/team-activity-tracker', [TeamEventsController::class, 'index'])->name('lr-team-activity-tracker');

                    Route::get('/dashboard/team/team-toppers', [TeamTopControllers::class, 'team_ten_toppers'])->name('lr-team-ten-toppers');

                    Route::get('/dashboard/ads-management', [AdsManagementController::class, 'index'])->name('lr-ads-management');
                });

                Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('lr-dashboard');

                Route::get('/dashboard/developers', [DeveloperController::class, 'index'])->name('lr-developer');

                Route::get('/dashboard/projects-search', [ProjectsController::class, 'index'])->name('lr-projects');

                Route::get('/dashboard/projectsid', [ProjectsController::class, 'edit_project_data'])->name('lr-projects');

                Route::get('/dashboard/developer/{developer_id}', [DeveloperController::class, 'projects'])->name('developer_projects');

                Route::get('/developer/delete/{developer_id}', [DeveloperController::class, 'delete_project'])->name('developer_delete');

                Route::get('/city/{province_id}', [AddressController::class, 'city'])->name('lr-city');

                Route::get('/barangay/{city_id}', [AddressController::class, 'barangay'])->name('lr-barangay');

                Route::get('/city_project_edit/{province_id}', [AddressController::class, 'city_project_edit'])->name('lr-city');

                Route::get('/barangay_project_edit/{city_id}', [AddressController::class, 'barangay_project_edit'])->name('lr-barangay');

                Route::get('/dashboard/member/new', [MemberController::class, 'newmembers'])->name('lr-members-new');

                Route::get('/dashboard/member/{status}', [MemberController::class, 'members_with_status'])->name('lr-members-status');

                Route::get('/dashboard/downline', [MemberController::class, 'get_current_downline'])->name('lr-downline-status');

                Route::get('/dashboard/profile', [MemberController::class, 'index'])->name('lr-profile');

                Route::get('/dashboard/profile/{member_id}', [MemberController::class, 'member_profile'])->name('lr-profile-search');

                Route::get('/dashboard/bdo-search', [MemberController::class, 'bdosearch'])->name('lr-bdosearch');

                Route::get('/dashboard/office-support', [OfficesController::class, 'officesearch'])->name('lr-dashboardoffices');

                Route::get('/project-edit/{project_id}', [DeveloperController::class, 'edit_project'])->name('lr-dev-project-edit');

                Route::get('/member/sales-report/{agent_id}', [MemberController::class, 'member_sales'])->name('lr-member-sales-report');

                Route::get('/dashboard/property-type/{prop_type_id}', [DashboardController::class, 'get_project_type'])->name('lr-property-type');

                Route::get('/dashboard/property-types', [DashboardController::class, 'get_project_types'])->name('lr-property-types');

                Route::get('/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-agent-toppers');

                Route::get('/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-sales-team-toppers');

                Route::get('/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-prev-agent-toppers');

                Route::get('/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-prev-team-toppers');

                Route::get('/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-prev-brokerage-agent-toppers');

                Route::get('/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-dev-agent-toppers');

                Route::get('/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-dev-toppers');

                Route::get('/dashboard/dev-current-toppers', [DashboardController::class, 'get_current_developer_toppers'])->name('lr-dev-current-toppers');

                Route::get('/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-birthday-celebrants');

                Route::get('/dashboard/curr-sales-report/{agent_id}', [DashboardController::class, 'get_curr_agent_sales_report'])->name('lr-agent-curr-sales-report');

                Route::get('/dashboard/curr-team-sales-report/{team_id}', [DashboardController::class, 'get_curr_team_sales_report'])->name('lr-team-curr-sales-report');

                Route::get('/dashboard/prev-sales-report/{agent_id}', [DashboardController::class, 'get_prev_agent_sales_report'])->name('lr-agent-prev-sales-report');

                Route::get('/dashboard/team-sales-report/{team_id}', [DashboardController::class, 'get_team_sales_report'])->name('lr-team-sales-report');

                Route::get('/dashboard/brokerage-sales-report/{agent_id}', [DashboardController::class, 'get_brokerage_sales_report'])->name('lr-brokerage-sales-report');

                Route::get('/dashboard/dev-sales-report/{dev_id}', [DashboardController::class, 'get_developer_sales_report'])->name('lr-developer-sales-report');

                // Route::get('/dashboard/filter-sales/{category}', [FilterSalesController::class, 'index'])->name('lr-filter-sales');

                // Route::get('/dashboard/filter-sales/category/{category}', [FilterSalesController::class, 'get_developers_total_sales'])->name('lr-filter-sales-category');

                Route::get('/dashboard/sales-validation/{prov_keyword}/{filter}', [SalesValidationController::class, 'index'])->name('lr-sales-validation');

                Route::get('/dashboard/sales-member-validation/{prov_keyword}/{filter}/member-sales/{agent_id}', [SalesValidationController::class, 'member_sales'])->name('lr-sales-member-validation');

                Route::get('/dashboard/sales-member-validation/{prov_keyword}/{filter}/member-sales/{agent_id}/{view}', [SalesValidationController::class, 'member_sales'])->name('lr-sales-member-validation-view');

                Route::get('/dashboard/phonebook', [Phonebookcontroller::class, 'index'])->name('lr-phonebook');

                Route::get('/dashboard/log-history', [LogHistoryController::class, 'index'])->name('lr-loghistory');

                Route::get('/dashboard/view-team-network-goals/{month}/{team}', [GoalSettingController::class, 'all_network_goals'])->name('lr-view-team-network-goals');

                Route::get('/dashboard/view-team-network-goals/subteam/{month}/{team}/{subteam}', [GoalSettingController::class, 'all_network_goals_subteam'])->name('lr-view-team-network-goals');

                Route::get('/dashboard/upload-forms', [UploadFormsController::class, 'index'])->name('lr-uploadforms');

                Route::get('/sales/source/{option}', [DashboardController::class, 'sales_source'])->name('lr-sales-source');

                Route::get('/developer/projects/{developer_id}', [DashboardController::class, 'developer_projects'])->name('lr-developer-projects');

                Route::get('/projects-edit/{edit_project_id}', [DashboardController::class, 'city'])->name('lr-city');

                Route::get('/dashboard/my-sales', [SalesReportController::class, 'mysales'])->name('lr-mysales');

                Route::get('/admin/sales-details', [SalesReportController::class, 'sales_details'])->name('lr-sales-details');

                Route::get('/dashboard/newly-added-sales', [SalesReportController::class, 'newly_added_sales'])->name('lr-newly-added-sales');

                Route::get('/dashboard/sales-report-count', [SalesReportController::class, 'newly_added_sales_count'])->name('lr-newly-added-sales-count');

                Route::get('/dashboard/special-announcements', [SpecialAnnouncementsControllers::class, 'index'])->name('lr-specialannouncements');

                Route::get('/dashboard/announcements/all', [AnnouncementsController::class, 'index'])->name('lr-announcements');

                Route::get('/dashboard/announcements/my-announcements', [AnnouncementsController::class, 'myannouncements'])->name('lr-announcements');

                Route::get('/dashboard/fund-for-fun', [FundforFunController::class, 'index'])->name('lr-fundforfun');

                Route::get('/dashboard/fund-for-fun/{member_name}', [FundforFunController::class, 'memberview'])->name('lr-fundforfun');

                Route::get('/dashboard/cash-advances', [CashAdvanceController::class, 'index'])->name('lr-cashadvance');

                Route::get('/dashboard/commissions', [CommissionController::class, 'index'])->name('lr-agentcommission');

                Route::get('/dashboard/my-commissions', [CommissionController::class, 'my_commission'])->name('lr-my-commission');

                Route::get('/dashboard/event-manager', [EventManagerController::class, 'index'])->name('lr-eventmanager');

                Route::get('/dashboard/authority-to-sell', [AuthorityToSellController::class, 'index'])->name('lr-authoritytosell');

                Route::get('/member-search', [MemberController::class, 'membersearch'])->name('lr-dashboard-membersearch');

                Route::get('/dashboard/marketing-materials', [MarketingMaterialsController::class, 'index'])->name('lr-marketing-materials');

                Route::get('/dashboard/memo', [MarketingMaterialsController::class, 'memo'])->name('lr-memo');

                Route::get('/dashboard/team-statistics', [SalesTeamStatistics::class, 'index'])->name('lr-sales-team-statistics');

                Route::get('/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-project-type');

                Route::get('/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-project-type');

                Route::get('/project/city/{city_id}', [ProjectsController::class, 'city_search'])->name('lr-project-type');

                Route::get('/dashboard/project-search', [ProjectsController::class, 'search_project'])->name('lr-project-search');

                Route::get('/dashboard/birthdaycelebrants', [BirthdayCelebrantsController::class, 'index'])->name('lr-birthdays');

                Route::get('/birthday-celebrants/{birthdate}', [BirthdayCelebrantsController::class, 'birthdayfilter'])->name('lr-birthdays');

                Route::get('/sales-locations', [SalesLocationController::class, 'get_provinces_with_sales'])->name('sales-locations');

                Route::get('/dashboard/birthdaycelebrants/{month}/{date}', [BirthdayCelebrantsController::class, 'birthdayfilter'])->name('lr-birthdays');

                Route::get('/dashboard/birthday-poster-maker', [BirthdayCelebrantsController::class, 'bdayposter'])->name('lr-birthday-poster');

                Route::get('/dashboard/memo/delete/{memo_id}', [MarketingMaterialsController::class, 'delete_memo'])->name('lr-memo');

                Route::get('/dashboard/marketing_materials/delete/{marketing_id}', [MarketingMaterialsController::class, 'delete_marketing'])->name('lr-marketing-materials');

                Route::get('/dashboard/marketingmemo/{marketing_type_id}', [MarketingMaterialsController::class, 'marketing_filter'])->name('lr-marketing-materials');

                Route::get('/dashboard/phonebook/delete/{phone_id}', [Phonebookcontroller::class, 'deletephone'])->name('lr-phonebook-delete');

                Route::get('/dashboard/heatmap-data', [ProjectsController::class, 'heatmap'])->name('lr-heatmap');

                Route::get('/dashboard/special-announcements-main', [DashboardController::class, 's_announcements'])->name('lr-special-main');

                Route::get('/dashboard/special-announcements/delete/{special_id}', [SpecialAnnouncementsControllers::class, 'deletes_announcements'])->name('lr-phonebook-delete');

                Route::get('/dashboard/special-announcements/hide/{special_id}', [SpecialAnnouncementsControllers::class, 'hide_announcement'])->name('lr-phonebook-hide');

                Route::get('/dashboard/special-announcements-editor/{special_id}', [SpecialAnnouncementsControllers::class, 's_announcements_edit'])->name('lr-special-edit');

                Route::get('/dashboard/forms/delete/{form_id}', [UploadFormsController::class, 'delete_form'])->name('lr-forms-delete');

                Route::get('/dashboard/forms/status', [UploadFormsController::class, 'update_form_status'])->name('lr-forms-status');

                Route::get('/dashboard/training-videos/delete/{video_id}', [TrainingVideosController::class, 'delete_video'])->name('lr-video-delete');

                // Route::get('/dashboard/team/team-toppers', [TeamTopControllers::class, 'team_ten_toppers'])->name('lr-team-ten-toppers');

                Route::get('/dashboard/profile/change-password/{member_id}', [MemberController::class, 'change_user_password'])->name('lr-team-ten-toppers');

                // Route::get('/dashboard/comments', [CommentsController::class, 'index'])->name('lr-comments');

                Route::get('/admin/search-team-statistics', [SalesTeamStatistics::class, 'search_team_statistics'])->name('lr-search-team-statistics');

                Route::get('/search-team-toppers', [SalesTeamStatistics::class, 'search_team_toppers'])->name('lr-search-team-toppers');

                Route::get('/dashboard/dataset/race-to-1B', [SalesTeamStatistics::class, 'race_to_1B'])->name('lr-race-to-1B-dataset');

                Route::get('/dashboard/race-to-1B', [SalesTeamStatistics::class, 'race_to_1B_statistics'])->name('lr-race-to-1B-statistics');

                Route::get('/dashboard/race-to-1B/team/{team_id}', [SalesTeamStatistics::class, 'race_to_1B_team'])->name('lr-race-to-1B-team');

                Route::get('/dashboard/dataset/jumpstart-to-1B', [SalesTeamStatistics::class, 'jumpstart_to_1B'])->name('lr-jumpstart-to-1B-dataset');

                Route::get('/dashboard/jumpstart-to-1B', [SalesTeamStatistics::class, 'race_to_1B_statistics'])->name('lr-jumpstart-to-1B-statistics');

                Route::get('/dashboard/jumpstart-to-1B/team/{team_id}', [SalesTeamStatistics::class, 'jumpstart_to_1B_team'])->name('lr-jumpstart-to-1B-team');

                Route::get('/dashboard/editing-datatable', [CommentsController::class, 'editing_table'])->name('lr-editing-table');

                Route::get('/commentdata', [CommentsController::class, 'commentdata'])->name('lr-commentdata');

                Route::get('/cash-advance/delete/{cashadvance_id}', [CashAdvanceController::class, 'remove_cash_advance'])->name('lr-cash-advance-delete');

                Route::get('/cash-advance/member/{cashadvance_id}', [CashAdvanceController::class, 'get_member'])->name('lr-cash-advance-edit');

                Route::get('/cash-advance/reject/{cashadvance_id}', [CashAdvanceController::class, 'reject_request'])->name('lr-cash-advance-reject');

                Route::get('/dashboard/certificate-maker', [CertificateController::class, 'index'])->name('lr-certificate-maker');

                Route::get('/certificate/delete/{certificate_idc}', [CertificateController::class, 'delete_certificate'])->name('lr-delete-certificate');

                Route::get('/commissions/get_project/{developer_id}', [CommissionController::class, 'get_projects'])->name('lr-commission-get-projects');

                Route::get('/commissions/delete/{commission_id}', [CommissionController::class, 'delete_commission'])->name('lr-commission-delete');

                Route::get('/commissions/get_commission/{commission_id}', [CommissionController::class, 'get_commission_data'])->name('lr-commission-get-data');

                Route::get('/dashboard/inbox', [InboxController::class, 'index'])->name('lr-inboxs');

                Route::get('/get-inbox-data', [InboxController::class, 'get_inbox'])->name('lr-get-inbox-data');

                Route::get('/get-sender-info/{memberid}', [InboxController::class, 'get_sender_info'])->name('lr-get-sender-info');

                Route::get('/developer/sales/reports/{dev_id}', [DeveloperController::class, 'developer_sales_reports'])->name('lr-developer-sales-reports');

                Route::get('/poster/monthly-awardees-poster', [PosterController::class, 'monthly_poster'])->name('lr-monthly-awardees-poster');

                Route::get('/dashboard/team-monthly-awardees', [PosterController::class, 'get_monthly_awardees_by_teamname'])->name('lr-team-monthly-awardees');

                Route::get('/dashboard/national-monthly-poster', [PosterController::class, 'national_monthly_poster'])->name('lr-national-monthly-poster');

                Route::get('/dashboard/product-knowledge-seminar-maker', [PosterController::class, 'pks_maker'])->name('lr-pks-maker');

                Route::get('/dashboard/birthday-poster-maker', [PosterController::class, 'birthday_poster'])->name('lr-birthday-poster-maker');

                Route::get('/get-inbox/{filter}', [InboxController::class, 'inbox_filter'])->name('lr-get-inbox');

                // Route::get('/developer/sales', [DeveloperController::class, 'developer_sales'])->name('lr-developer-sales');

                Route::get('/dashboard/national-monthly-poster', [PosterController::class, 'national_monthly_poster'])->name('lr-national-monthly-poster');

                Route::get('/dashboard/birthday-poster-maker', [PosterController::class, 'birthday_poster'])->name('lr-birthday-poster-maker');

                Route::get('/dashboard/natcon', [MemberNatconController::class, 'index'])->name('lr-natcon-toppers');

                Route::get('/dashboard/natcon/{year}', [MemberNatconController::class, 'index'])->name('lr-natcon-toppers-filter');

                Route::get('/dashboard/natcon-member-toppers', [MemberNatconController::class, 'team_member_toppers'])->name('lr-natcon-member-toppers');

                Route::get('/dashboard/natcon-team-toppers', [MemberNatconController::class, 'team_toppers'])->name('lr-natcon-team-toppers');

                Route::get('/dashboard/natcon-subteam-toppers', [MemberNatconController::class, 'subteam_toppers'])->name('lr-natcon-subteam-toppers');

                // Route::get('/dashboard/team-recruits', [SalesTeamStatistics::class, 'team_recruits'])->name('lr-team-recruits');

                Route::get('/dashboard/active-teams', [SalesTeamStatistics::class, 'active_teams'])->name('lr-active-teams');

                Route::get('/dashboard/sql/{teamid}/{from}/{to}', [SalesTeamStatistics::class, 'active_teams2'])->name('lr-active-teams2');

                Route::get('/dashboard/sql3/{teamid}/{from}/{to}', [SalesTeamStatistics::class, 'active_teams3'])->name('lr-active-teams3');

                Route::get('/dashboard/top-developers', [DeveloperController::class, 'top_developers'])->name('lr-top-developers');

                // Route::get('/dashboard/developer-statistics', [DeveloperController::class, 'developer_statistics'])->name('lr-developer-statistics');

                // Route::get('/dashboard/developer-statistics/{dev_id}', [DeveloperController::class, 'developer_statistics_data'])->name('lr-developer-statistics-data');

                Route::get('/dashboard/agents-sales', [MemberController::class, 'members_sales'])->name('lr-agents-sales');

                Route::get('/dashboard/brokerages-sales', [BrokerageController::class, 'index'])->name('lr-brokerages-sales');

                Route::get('/dashboard/admin-main/{view}', [DashboardController::class, 'admin_main'])->name('lr-admin-main');

                Route::get('/dashboard/admin-main/natcon/agent/qualifiers', [MemberNatconController::class, 'filter_natcon_agent_qualifiers'])->name('lr-filter-natcon-agent-qualifiers');

                Route::get('/dashboard/admin-main/natcon/agent-qualifiers/{year}', [MemberNatconController::class, 'filter_natcon_agent_qualifiers'])->name('lr-filter-natcon-agent-qualifiers-year');

                Route::get('/dashboard/admin-main/natcon/top-developers', [MemberNatconController::class, 'natcon_top_developers'])->name('lr-natcon-top-developers');

                Route::get('/dashboard/admin-main/natcon/top-developers/{year}', [MemberNatconController::class, 'natcon_top_developers'])->name('lr-natcon-top-developers-year');

                Route::get('/dashboard/admin-main/natcon/top-developers-data', [MemberNatconController::class, 'natcon_top_developers_data'])->name('lr-natcon-top-developers-data');

                Route::get('/dashboard/admin-main/natcon/top-teams', [MemberNatconController::class, 'natcon_top_teams'])->name('lr-natcon-top-teams');

                Route::get('/dashboard/admin-main/natcon/top-subteams', [MemberNatconController::class, 'natcon_top_subteams'])->name('lr-natcon-top-subteams');

                Route::get('/dashboard/admin-main/natcon/top-subteams/{year}', [MemberNatconController::class, 'natcon_top_subteams'])->name('lr-natcon-top-subteams-year');

                Route::get('/dashboard/admin-main/natcon/top-teams/{year}', [MemberNatconController::class, 'natcon_top_teams'])->name('lr-natcon-top-teams-year');

                Route::get('/dashboard/upline-requests', [UplineRequestController::class, 'index'])->name('lr-upline-requests');

                // Route::get('/dashboard/team-activity-tracker', [TeamEventsController::class, 'index'])->name('lr-team-activity-tracker');

                Route::get('/dashboard/delete-event-title/{eventid}', [TeamEventsController::class, 'delete_event_title'])->name('lr-delete-event-title');

                Route::get('/dashboard/get-events', [TeamEventsController::class, 'get_events'])->name('lr-get-events');

                Route::get('/dashboard/get-event-title/{event_id}', [TeamEventsController::class, 'get_event_title'])->name('lr-get-event-title');

                Route::get('/dashboard/get-event-lists/', [TeamEventsController::class, 'get_event_lists'])->name('lr-get-event-lists');

                Route::get('/dashboard/remove-calendar-event/{event_id}', [TeamEventsController::class, 'remove_calendar_event'])->name('lr-remove-calendar-event');

                Route::get('/dashboard/get-calendar-event/{event_id}', [TeamEventsController::class, 'get_calendar_event'])->name('lr-get-calendar-event');

                Route::get('/dashboard/member-search/{key_word}', [MemberController::class, 'member_search_sales'])->name('lr-member-search');

                Route::get('/dashboard/event-manager', [EventManagerController::class, 'event_manager'])->name('lr-event-manager');

                // Route::get('/dashboard/teams', [SalesTeamStatistics::class, 'sales_teams'])->name('lr-sales-teams');

                // Route::get('/dashboard/teams-data', [SalesTeamStatistics::class, 'sales_team_data'])->name('lr-sales-teams-data');

                // Route::get('/dashboard/get-salesteam', [SalesTeamStatistics::class, 'get_sales_team'])->name('lr-get-sales-teams');

                // Route::get('/dashboard/get-members', [SalesTeamStatistics::class, 'get_members'])->name('lr-get-members');

                // Route::get('/dashboard/ads-management', [AdsManagementController::class, 'index'])->name('lr-ads-management');

                Route::get('/database-seeder', [MemberController::class, 'database_seeder']);

                Route::get('/search-an-agent', [MemberController::class, 'search_an_agent'])->name('lr-search-an-agent');

                Route::get('/search-an-agent-data', [MemberController::class, 'get_agent_searches_data'])->name('lr-search-an-agent-data');

                Route::get('/dashboard/ebook', [EbookController::class, 'index'])->name('lr-ebook');

                Route::get('/poster/background', [PosterController::class, 'monthly_poster_background'])->name('lr-monthly-poster-background');

                Route::get('dashboard/monthly-awardees-poster', [PosterController::class, 'monthly_awardees_poster'])->name('lr-monthly-poster');

                Route::get('/monthly-awardees-poster-data', [PosterController::class, 'get_monthly_awardees_by_teamname'])->name('lr-monthly-awardees-poster-data');

                Route::get('/location-awardees-poster-data', [PosterController::class, 'get_monthly_awardees_by_location'])->name('lr-location-awardees-poster-data');

                Route::get('/notifications/{category}', [NotificationsController::class, 'index'])->name('lr-notifications');

                Route::get('/notifications-data/{category}', [NotificationsController::class, 'notifications_data'])->name('lr-notifications-data');

                Route::get('/admin/comment-details', [AgentCommentsController::class, 'comment_details'])->name('lr-comment-details');

                Route::get('/admin/tree-downline', [AgentMemberController::class, 'tree_downline'])->name('lr-agent-role-tree-downline');

                Route::get('/dashboard/sales-team/{team_id}', [SupervisorMemberController::class, 'sales_team_members'])->name('lr-sales-team-members');

                Route::get('/dashboard/team-recruits-view/{team_id}', [SupervisorSalesTeamStatistics::class, 'team_recruits'])->name('lr-view-team-recruits');

                Route::get('/dashboard/team/data/members', [SupervisorMemberController::class, 'get_all_team_members'])->name('lr-sales-team-members-data');

                Route::get('/dashboard/birthday-poster-generator', [BirthdayCelebrantsController::class, 'birthday_generator'])->name('lr-birthday-poster-generator');

                Route::get('/dashboard/team-management', [SalesTeamController::class, 'manage_team'])->name('lr-team-management');

                Route::get('/dashboard/fetch_fire_certs', [MemberController::class, 'fetch_fire_certs']);

                Route::get('/dashboard/all-team-activities-tracker', [TeamEventsController::class, 'all_teams'])->name('lr-all-team-activities-viewer');

                Route::get('/dashboard/manage-team/{team_id}', [SalesTeamController::class, 'manage_team'])->name('lr-manage-team');

                Route::get('/dashboard/view-empty-names', [MemberController::class, 'members_empty_names']);

                // Route::get('/dashboard/heatmap/members', [HeatmapController::class, 'index'])->name('lr-heatmap-members');

                // Route::get('/dashboard/heatmap/members-data', [HeatmapController::class, 'heatmap_data'])->name('lr-heatmap-members-data');

                Route::get('/dashboard/certificate-generator', [CertificateController::class, 'cert_generator'])->name('lr-certificate-generator');

                Route::get('/dashboard/subteam-statistics-data', [SalesReportController::class, 'subteam_statistics_data'])->name('lr-subteam-statistics-data');

                Route::get('/dashboard/subteam-stat', [SalesReportController::class, 'subteam_stat']);

                Route::get('/dashboard/agent-um-qualified', [SalesReportController::class, 'all_time_sales'])->name('lr-agent-statistics-data');

                Route::get('/dashboard/brokers', [SalesReportController::class, 'brokers'])->name('lr-broker-statistics-data');

                Route::get('/dashboard/letter-generator', [ContactController::class, 'letter_generator'])->name('lr-letter-generator');

                Route::get('/dashboard/letter-generator/coe', [ContactController::class, 'coe'])->name('lr-letter-generator-coe');

                Route::get('/dashboard/view/developers', [DeveloperController::class, 'view_developer_page'])->name('lr-view-developers');

                Route::get('/dashboard/developers/get-list', [DeveloperController::class, 'view_developers'])->name('lr-get-developers-list');

                Route::get('/dashboard/cli-sales', [SalesReportController::class, 'temp_developer_team_sales'])->name('lr-cli-sales');

                Route::get('/reuploaded-sales', [SalesReportController::class, 'get_sales_with_reuploaded_pot']);

                Route::get('/dashboard/certificate-event-maker', [CertificateController::class, 'certificate_event_maker'])->name('lr-certificate-event-maker');

                Route::get('/dashboard/developer/{dev_id}/projects', [DeveloperController::class, 'viewProjects']);

                Route::get('/dashboard/subteam-present-sales', [SalesTeamSubTeamController::class, 'subTeamPresentSales']);

                // --- LR POST METHODS ---

                Route::middleware('xss')->group(function () {

                    Route::post('/add-project', [DeveloperController::class, 'store_project'])->name('lr-developer-add-project');

                    Route::post('/add-sale', [DashboardController::class, 'store_sale'])->name('lr-add-sale');

                    Route::post('/add-phonebook', [PhonebookController::class, 'add_to_phonebook'])->name('lr-phonebook-add');

                    Route::post('/edit-phonebook', [PhonebookController::class, 'edit_to_phonebook'])->name('lr-phonebook-edit');

                    Route::post('/admin/edit-pot', [SalesValidationController::class, 'update_pot'])->name('lr-update-pot');

                    Route::post('add-memo', [MarketingMaterialsController::class, 'add_new_memo'])->name('lr-memo-new');

                    Route::post('add-materials', [MarketingMaterialsController::class, 'add_new_materials'])->name('lr-marketing-new');

                    Route::post('/add-forms', [UploadFormsController::class, 'add_to_forms'])->name('lr-forms-add');

                    Route::post('/activate-member', [MemberController::class, 'activate_member'])->name('lr-activate-member');

                    Route::post('/deactivate-member', [MemberController::class, 'deactivate_member'])->name('lr-deactivate-member');

                    Route::post('/add-videos', [TrainingVideosController::class, 'add_video'])->name('lr-videos-add');

                    Route::post('/update-comments', [CommentsController::class, 'update_comments'])->name('lr-comments-update');

                    Route::post('/update-profile', [MemberController::class, 'update_profile'])->name('lr-profile-update');

                    Route::post('/edit-developer', [DeveloperController::class, 'edit_developer'])->name('lr-developer-info-edit');

                    Route::post('/add-developer', [DeveloperController::class, 'add_developer'])->name('lr-developer-info-add');

                    Route::post('/edit-project', [ProjectsController::class, 'project_edit'])->name('lr-project-info-edit');

                    Route::post('/add-cash-advance', [CashAdvanceController::class, 'add_cash_advance'])->name('lr-add-cash-advance');

                    Route::post('/edit-cash-advance', [CashAdvanceController::class, 'edit_cash_advance'])->name('lr-edit-cash-advance');

                    Route::post('/request-cash-advance', [CashAdvanceController::class, 'request_cash_advance'])->name('lr-request-cash-advance');

                    Route::post('/approve-cash-advance', [CashAdvanceController::class, 'approve_cash_advance'])->name('lr-approve-cash-advance');

                    Route::post('/payments-cash-advance', [CashAdvanceController::class, 'payments_cash_advance'])->name('lr-payments-cash-advance');

                    Route::post('/add-certificate-template', [CertificateController::class, 'add_certificate_template'])->name('lr-add-certificate-template');

                    Route::post('/add-commission-data', [CommissionController::class, 'add_commission_data'])->name('lr-add-commission-data');

                    Route::post('/edit-commission-data', [CommissionController::class, 'edit_commission_data'])->name('lr-edit-commission-data');

                    Route::post('/delete-commission-data', [CommissionController::class, 'delete_commission_data'])->name('lr-delete-commission-data');

                    Route::post('/change-upline', [UplineRequestController::class, 'change_upline_request'])->name('lr-change-upline');

                    Route::post('/add-event', [TeamEventsController::class, 'add_event'])->name('lr-add-event');

                    Route::post('/add-chat-support', [AppSupportController::class, 'store_message'])->name('lr-store-message');

                    Route::post('/add-event-activity', [TeamEventsController::class, 'add_activity'])->name('lr-add-event-activity');

                    Route::post('/dashboard/event/certificate/delete', [CertificateController::class, 'delete_certificate_event'])->name('lr-certificate-event-delete');

                    Route::post('/revalidate-sales', [SalesValidationController::class, 'revalidate_sales'])->name('lr-revalidate-sales');

                    Route::post('/add-developer-link', [DeveloperController::class, 'add_developer_link'])->name('lr-developer-link-add');

                    Route::post('/update-notification', [NotificationsController::class, 'update_notification'])->name('lr-update-notification');

                    Route::post('/reply-support', [AgentCommentsController::class, 'reply_support'])->name('lr-reply-support');

                    Route::post('/edit-member-credential', [SupervisorMemberController::class, 'edit_member_credential'])->name('lr-edit-member-credential');

                    Route::post('/add-presentation', [PresentationsController::class, 'add_presentations'])->name('lr-add-presentation');

                    Route::post('process-team-transfer', [SalesTeamController::class, 'transfer_team_member'])->name('lr-process-team-transfer');

                    Route::post('/replace/memberlogs', [ActivityLogsController::class, 'replace_txt_file'])->name('lr-replace-txt-file');

                    Route::post('/dashboard/event/certificate/upload', [CertificateController::class, 'upload_certificate_event'])->name('lr-certificate-event-upload');
                });

                Route::post('/s-announcements-add', [SpecialAnnouncementsControllers::class, 'add_new_s_announcements'])->name('lr-s-announcements-add');

                Route::post('/add-popup-content', [AdsManagementController::class, 'add_popup_content'])->name('lr-ads-management-add-popup');

                Route::post('/s-announcements-banner', [SpecialAnnouncementsControllers::class, 'banner_announcements'])->name('lr-s-announcements-banner');

                Route::post('/s-announcements-news', [SpecialAnnouncementsControllers::class, 'news_announcements'])->name('lr-s-announcements-news');

                Route::get('/system-maintenance', [AdminController::class, 'index'])->name('lr-system-maintenance');
            });

            // LR - AGENT ROLE DASHBOARD ---
            Route::middleware('auth.agent')->group(function () {

                Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('lr-agent-role-dashboard');

                Route::get('/agent/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-agent-role-birthday-celebrants');

                Route::get('/agent/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-agent-role-toppers');

                Route::get('/agent/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-agent-role-sales-team-toppers');

                Route::get('/agent/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-agent-role-prev-agent-toppers');

                Route::get('/agent/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-agent-role-prev-team-toppers');

                Route::get('/agent/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-agent-role-prev-brokerage-agent-toppers');

                Route::get('/agent/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-agent-role-dev-agent-toppers');

                Route::get('/agent/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-agent-role-dev-toppers');

                Route::get('/agent/dashboard/property-types', [DashboardController::class, 'get_project_types'])->name('lr-agent-role-property-types');

                Route::get('/agent/sales/source/{option}', [DashboardController::class, 'sales_source'])->name('lr-agent-role-sales-source');

                Route::get('/agent/developer/projects/{developer_id}', [DashboardController::class, 'developer_projects'])->name('lr-agent-role-developer-projects');

                Route::get('/agent/dashboard/property-type/{prop_type_id}', [DashboardController::class, 'get_project_type'])->name('lr-agent-role-property-type');

                Route::get('/agent/dashboard/profile', [AgentMemberController::class, 'index'])->name('lr-agent-role-profile');

                Route::get('/agent/dashboard/profile/{member_id}', [AgentMemberController::class, 'index'])->name('lr-agent-role-profile-search');

                Route::get('/agent/dashboard/my-sales', [AgentSalesReportController::class, 'mysales'])->name('lr-agent-role-mysales');

                Route::get('/agent/dashboard/project-search', [AgentProjectsController::class, 'search_project'])->name('lr-agent-role-project-search');

                Route::get('/agent/dashboard/projects-search', [AgentProjectsController::class, 'index'])->name('lr-agent-role-projects-search');

                Route::get('/agent/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-agent-role-project-type');

                Route::get('/agent/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-agent-role-project-type');

                Route::get('/agent/dashboard/developers', [AgentDeveloperController::class, 'index'])->name('lr-agent-role-developer');

                Route::get('/agent/dashboard/developer/{developer_id}', [AgentDeveloperController::class, 'projects'])->name('lr-agent-role-developer-projects-1');

                Route::get('/agent/sales-locations', [SalesLocationController::class, 'get_provinces_with_sales'])->name('lr-agent-role-sales-locations');

                Route::get('/agent/dashboard/office-support', [AgentOfficesController::class, 'officesearch'])->name('lr-agent-role-dashboardoffices');

                Route::get('/agent/dashboard/marketing-materials', [AgentMarketingMaterialsController::class, 'index'])->name('lr-agent-role-marketing-materials');

                Route::get('/agent/dashboard/marketingmemo/{marketing_type_id}', [AgentMarketingMaterialsController::class, 'marketing_filter'])->name('lr-agent-role-marketing-materials');

                Route::get('/agent/dashboard/memo', [AgentMarketingMaterialsController::class, 'memo'])->name('lr-agent-role-memo');

                Route::get('/agent/dashboard/training-videos', [AgentTrainingVideosController::class, 'index'])->name('lr-agent-role-training-videos');

                Route::get('/agent/dashboard/upload-forms', [AgentUploadFormsController::class, 'index'])->name('lr-agent-role-uploadforms');

                Route::get('/agent/dashboard/my-commissions', [AgentCommissionController::class, 'my_commission'])->name('lr-agent-my-commission');

                Route::get('/agent/dashboard/downline', [AgentMemberController::class, 'get_current_downline'])->name('lr-role-agent-downline-status');

                Route::post('/agent/change-profile-pic', [AgentMemberController::class, 'changeprofile'])->name('lr-agent-change-profile-pic');

                Route::post('/agent/edit-profile-pic', [AgentMemberController::class, 'editimgprofile'])->name('lr-agent-edited-profile-pic');

                Route::get('/agent/view-support-response', [AgentCommentsController::class, 'view_support_response'])->name('lr-agent-role-view-support-response');

                Route::get('/agent/comment-details', [AgentCommentsController::class, 'comment_details'])->name('lr-agent-role-comment-details');

                Route::get('/agent/tree-downline', [AgentMemberController::class, 'tree_downline'])->name('lr-agent-role-tree-downline');

                Route::get('/agent/ebook', [EbookController::class, 'index'])->name('lr-ebook');

                Route::middleware('xss')->group(function () {

                    Route::post('/agent/add-sale', [DashboardController::class, 'store_sale'])->name('lr-agent-role-add-sale');

                    Route::post('/agent/add-comments', [CommentsController::class, 'add_comments'])->name('lr-agent-role-comments-add');

                    Route::post('/agent/update-profile', [MemberController::class, 'update_profile'])->name('lr-agent-role-update');

                    Route::post('/agent/edit-pot', [SalesValidationController::class, 'update_pot'])->name('lr-agent-role-update-pot');

                    Route::post('/agent/update-comment', [AgentCommentsController::class, 'update_seen_status'])->name('lr-agent-role-update-seen-status');

                    Route::post('/agent/reply-support', [AgentCommentsController::class, 'reply_support'])->name('lr-agent-role-reply-support');
                });
            });

            // LR - SUPERVISOR ROLE DASHBOARD ---
            Route::middleware('auth.supervisor')->group(function () {

                Route::get('/tl/dashboard', [SupervisorDashboardController::class, 'index'])->name('lr-supervisor-role-dashboard');

                Route::get('/tl/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-supervisor-role-birthday-celebrants');

                Route::get('/tl/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-supervisor-role-toppers');

                Route::get('/tl/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-supervisor-role-sales-team-toppers');

                Route::get('/tl/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-supervisor-role-prev-agent-toppers');

                Route::get('/tl/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-supervisor-role-prev-team-toppers');

                Route::get('/tl/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-supervisor-role-prev-brokerage-agent-toppers');

                Route::get('/tl/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-supervisor-role-dev-agent-toppers');

                Route::get('/tl/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-supervisor-role-dev-toppers');

                Route::get('/tl/dashboard/property-types', [DashboardController::class, 'get_project_types'])->name('lr-supervisor-role-property-types');

                Route::get('/tl/dashboard/property-type/{prop_type_id}', [DashboardController::class, 'get_project_type'])->name('lr-agent-role-property-type');

                Route::get('/tl/sales/source/{option}', [DashboardController::class, 'sales_source'])->name('lr-supervisor-role-sales-source');

                Route::get('/tl/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-supervisor-role-project-type');

                Route::get('/tl/developer/projects/{developer_id}', [DashboardController::class, 'developer_projects'])->name('lr-supervisor-role-developer-projects');

                Route::get('/tl/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-supervisor-role-project-type');

                Route::get('/tl/dashboard/profile', [SupervisorMemberController::class, 'index'])->name('lr-supervisor-role-profile');

                Route::get('/tl/dashboard/profile/{member_id}', [SupervisorMemberController::class, 'member_profile'])->name('lr-supervisor-role-profile-search');

                Route::get('/tl/dashboard/my-sales', [SupervisorSalesReportController::class, 'mysales'])->name('lr-supervisor-role-mysales');

                Route::get('/tl/dashboard/project-search', [SupervisorProjectsController::class, 'search_project'])->name('lr-supervisor-role-project-search');

                Route::get('/tl/dashboard/projects-search', [SupervisorProjectsController::class, 'index'])->name('lr-supervisor-role-projects-search');

                Route::get('/tl/dashboard/dataset/race-to-1B', [SupervisorSalesTeamStatistics::class, 'race_to_1B'])->name('lr-supervisor-race-to-1B-dataset');

                Route::get('/tl/dashboard/race-to-1B', [SupervisorSalesTeamStatistics::class, 'race_to_1B_statistics'])->name('lr-supervisor-role-race-to-1B-statistics');

                // Route::get('/tl/dashboard/downline', [MemberController::class, 'get_current_downline'])->name('lr-supervisor-downline-status');

                Route::get('/tl/dashboard/my-commissions', [SupervisorCommissionController::class, 'my_commission'])->name('lr-supervisor-role-my-commission');

                Route::get('/tl/dashboard/downline', [SupervisorMemberController::class, 'current_downline'])->name('lr-role-supervisor-downline-status');

                Route::get('/tl/dashboard/downline/data', [SupervisorMemberController::class, 'get_current_downline_data'])->name('lr-role-supervisor-downline-status-data');

                Route::get('/tl/dashboard/team/data/members', [SupervisorMemberController::class, 'sales_team_members_data'])->name('lr-role-supervisor-sales-team-members-data');

                Route::get('/tl/dashboard/team/data/toppers', [SupervisorMemberController::class, 'sales_team_top_ten'])->name('lr-role-supervisor-sales-team-top-ten-data');

                Route::get('/tl/dashboard/team/members', [SupervisorMemberController::class, 'sales_team_members'])->name('lr-role-supervisor-sales-team-members');

                Route::get('/tl/dashboard/team/toppers', [SupervisorMemberController::class, 'sales_team_toppers'])->name('lr-role-supervisor-sales-team-toppers');

                Route::get('/tl/dashboard/team/statistics', [SupervisorSalesTeamStatistics::class, 'team_chart_statistics'])->name('lr-role-supervisor-team-chart-statistics');

                Route::get('/tl/search-team-statistics', [SalesTeamStatistics::class, 'search_team_statistics'])->name('lr-role-supervisor-search-team-statistics');

                Route::get('/tl/dashboard/main', [SupervisorTLDashboardController::class, 'index'])->name('lr-role-supervisor-tl-dashboard');

                Route::get('/tl/dashboard/main/view-sales/{page}', [SupervisorSalesReportController::class, 'monitor_team_sales'])->name('lr-role-supervisor-view-sales');

                Route::get('/tl/dashboard/view-team-network-goals/{month}/{team}', [GoalSettingController::class, 'team_network'])->name('lr-supervisor-team-network-goals');

                Route::get('/tl/dashboard/view-team-network-goals/subteam/{month}/{team}/{subteam}', [GoalSettingController::class, 'subteam_network'])->name('lr-supervisor-team-network-goals');

                Route::get('/tl/sales-locations', [SalesLocationController::class, 'get_provinces_with_sales'])->name('lr-role-supervisor-sales-locations');

                Route::get('/tl/dashboard/main/monitor-team-sales/view-sales/{agent_id}', [SupervisorSalesReportController::class, 'view_member_sales'])->name('lr-role-supervisor-view-member-sales');

                Route::get('/tl/dashboard/main/developers/top-projects', [SupervisorSalesReportController::class, 'get_top_dev_projects'])->name('lr-role-supervisor-top-dev-projects');

                Route::get('/tl/dashboard/main/subteam/subteam-toppers/data', [SupervisorMemberController::class, 'sales_team_toppers_data'])->name('lr-role-supervisor-subteam-toppers-data');

                Route::get('/tl/dashboard/main/subteam/subteam-toppers', [SupervisorMemberController::class, 'sub_team_toppers'])->name('lr-role-supervisor-subteam-toppers');

                Route::get('/tl/dashboard/main/natcon-qualifiers', [SupervisorMemberController::class, 'natcon_qualifiers'])->name('lr-role-supervisor-natcon-qualifiers');

                Route::get('/tl/dashboard/developers', [SupervisorDeveloperController::class, 'index'])->name('lr-role-supervisor-developer');

                Route::get('/tl/dashboard/developer/{developer_id}', [SupervisorDeveloperController::class, 'projects'])->name('lr-role-supervisor-developer-projects');

                Route::get('/tl/city/{province_id}', [AddressController::class, 'city'])->name('lr-supervisor-role-city');

                Route::get('/tl/barangay/{city_id}', [AddressController::class, 'barangay'])->name('lr-supervisor-role-barangay');

                Route::get('/tl/dashboard/marketing-materials', [SupervisorMarketingMaterialsController::class, 'index'])->name('lr-marketing-materials');

                Route::get('/tl/dashboard/memo', [SupervisorMarketingMaterialsController::class, 'memo'])->name('lr-supervisor-role-memo');

                Route::get('/tl/dashboard/office-support', [SupervisorOfficesController::class, 'officesearch'])->name('lr-supervisor-role-dashboardoffices');

                Route::get('/tl/dashboard/training-videos', [SupervisorTrainingVideosController::class, 'index'])->name('lr-supervisor-role-training-videos');

                Route::get('/tl/dashboard/upload-forms', [SupervisorUploadFormsController::class, 'index'])->name('lr-supervisor-role-uploadforms');

                Route::get('/tl/dashboard/team-recruits', [SupervisorSalesTeamStatistics::class, 'team_recruits'])->name('lr-supervisor-team-recruits');

                Route::get('/tl/dashboard/team-activity-tracker', [SupervisorTeamEventsController::class, 'index'])->name('lr-supervisor-team-activity-tracker');

                Route::get('/tl/dashboard/delete-event-title/{eventid}', [SupervisorTeamEventsController::class, 'delete_event_title'])->name('lr-supervisor-delete-event-title');

                Route::get('/tl/dashboard/get-events', [SupervisorTeamEventsController::class, 'get_events'])->name('lr-supervisor-get-events');

                Route::get('/tl/dashboard/get-event-title/{event_id}', [SupervisorTeamEventsController::class, 'get_event_title'])->name('lr-supervisor-get-event-title');

                Route::get('/tl/dashboard/get-event-lists/', [SupervisorTeamEventsController::class, 'get_event_lists'])->name('lr-supervisor-get-event-lists');

                Route::get('/tl/dashboard/remove-calendar-event/{event_id}', [SupervisorTeamEventsController::class, 'remove_calendar_event'])->name('lr-supervisor-remove-calendar-event');

                Route::get('/tl/dashboard/get-calendar-event/{event_id}', [SupervisorTeamEventsController::class, 'get_calendar_event'])->name('lr-supervisor-get-calendar-event');

                Route::get('/tl/dashboard/subteams', [SupervisorMemberController::class, 'sub_teams'])->name('lr-supervisor-subteams');

                Route::get('/tl/dashboard/subteam/members/{leader_id}', [UnitManagerMemberController::class, 'sales_subteam_members'])->name('lr-role-supervisor-sales-subteam-members');

                Route::get('/tl/dashboard/subteam/data/members/{leader_id}', [UnitManagerMemberController::class, 'sales_team_subteam_members_data'])->name('lr-role-supervisor-sales-team-members-data');

                Route::get('/tl/dashboard/subteam-recruits/{leader_id}', [UnitManagerSalesTeamStatistics::class, 'team_recruits'])->name('lr-supervisor-subteam-recruits');

                Route::get('/tl/certificate-maker', [CertificateController::class, 'index'])->name('lr-certificate-maker');

                Route::get('/tl/product-knowledge-seminar-maker', [PosterController::class, 'pks_maker'])->name('lr-pks-maker');

                Route::get('/tl/ebook', [EbookController::class, 'index'])->name('lr-ebook');

                Route::get('/tl/view-support-response', [SupervisorCommentsController::class, 'view_support_response'])->name('lr-supervisor-role-view-support-response');

                Route::get('/tl/comment-details', [AgentCommentsController::class, 'comment_details'])->name('lr-supervisor-role-comment-details');

                Route::get('/tl/tree-downline', [AgentMemberController::class, 'tree_downline'])->name('lr-agent-role-tree-downline');

                Route::get('/tl/birthday-poster-generator', [BirthdayCelebrantsController::class, 'birthday_generator'])->name('lr-birthday-poster-generator');

                Route::get('/tl/monthly-awardees-poster', [PosterController::class, 'tl_monthly_awardees_poster'])->name('lr-supervisor-monthly-poster');

                Route::get('/tl/team-monthly-awardees', [PosterController::class, 'get_monthly_awardees_by_teamname'])->name('lr-supervisor-team-monthly-awardees');

                Route::middleware('xss')->group(function () {

                    Route::post('/tl/add-sale', [DashboardController::class, 'store_sale'])->name('lr-supervisor-role-add-sale');

                    Route::post('/tl/add-comments', [CommentsController::class, 'add_comments'])->name('lr-supervisor-role-comments-add');

                    Route::post('/tl/update-profile', [MemberController::class, 'update_profile'])->name('lr-supervisor-role-update');

                    Route::post('/tl/add-member', [SupervisorMemberController::class, 'add_team_member'])->name('lr-supervisor-role-add-team-member');

                    Route::post('/tl/edit-member', [SupervisorMemberController::class, 'update_team_member'])->name('lr-supervisor-role-edit-team-member');

                    Route::post('/tl/change-upline', [UplineRequestController::class, 'change_upline_request'])->name('lr-supervisor-change-upline');

                    Route::post('/tl/add-event', [SupervisorTeamEventsController::class, 'add_event'])->name('lr-supervisor-add-event');

                    Route::post('/tl/add-event-activity', [SupervisorTeamEventsController::class, 'add_activity'])->name('lr-supervisor-add-event-activity');

                    Route::post('/tl/change-profile-pic', [SupervisorMemberController::class, 'change_profile'])->name('lr-supervisor-change-profile-pic');

                    Route::post('/tl/edit-pot', [SalesValidationController::class, 'update_pot'])->name('lr-supervisor-role-update-pot');

                    Route::post('/tl/update-comment', [AgentCommentsController::class, 'update_seen_status'])->name('lr-supervisor-role-update-seen-status');
                });
            });

            // LR - UNIT MANAGER ROLE DASHBOARD ---
            Route::middleware('auth.unit-manager')->group(function () {

                Route::get('/um/dashboard', [UnitManagerDashboardController::class, 'index'])->name('lr-um-role-dashboard');

                Route::get('/um/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-um-role-birthday-celebrants');

                Route::get('/um/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-um-role-toppers');

                Route::get('/um/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-um-role-sales-team-toppers');

                Route::get('/um/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-um-role-prev-agent-toppers');

                Route::get('/um/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-um-role-prev-team-toppers');

                Route::get('/um/dashboard/view-team-network-goals/subteam/{month}/{team}/{subteam}', [GoalSettingController::class, 'um_subteam_network'])->name('lr-um-subteam-network-goals');

                Route::get('/um/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-um-role-prev-brokerage-agent-toppers');

                Route::get('/um/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-um-role-dev-agent-toppers');

                Route::get('/um/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-um-role-dev-toppers');

                Route::get('/um/dashboard/property-types', [DashboardController::class, 'get_project_types'])->name('lr-um-role-property-types');

                Route::get('/um/dashboard/property-type/{prop_type_id}', [DashboardController::class, 'get_project_type'])->name('lr-um-role-property-type');

                Route::get('/um/sales/source/{option}', [DashboardController::class, 'sales_source'])->name('lr-um-role-sales-source');

                Route::get('/um/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-um-role-project-type');

                Route::get('/um/developer/projects/{developer_id}', [DashboardController::class, 'developer_projects'])->name('lr-um-role-developer-projects');

                Route::get('/um/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-um-role-project-type');

                Route::get('/um/dashboard/project-search', [UnitManagerProjectsController::class, 'search_project'])->name('lr-um-role-project-search');

                Route::get('/um/dashboard/my-sales', [UnitManagerSalesReportController::class, 'mysales'])->name('lr-um-role-mysales');

                Route::get('/um/dashboard/my-commissions', [UnitManagerProjectsController::class, 'my_commission'])->name('lr-um-role-my-commission');

                Route::get('/um/dashboard/main', [UnitManagerTLDashboardController::class, 'index'])->name('lr-role-um-tl-dashboard');

                Route::get('/um/dashboard/main/view-sales/{page}', [UnitManagerSalesReportController::class, 'monitor_team_sales'])->name('lr-role-um-view-sales');

                Route::get('/um/dashboard/downline/data', [UnitManagerMemberController::class, 'get_current_downline_data'])->name('lr-role-um-downline-status-data');

                Route::get('/um/dashboard/profile', [UnitManagerMemberController::class, 'index'])->name('lr-um-role-profile');

                Route::get('/um/dashboard/profile/{member_id}', [UnitManagerMemberController::class, 'member_profile'])->name('lr-um-role-profile-search');

                Route::get('/um/sales-locations', [SalesLocationController::class, 'get_provinces_with_sales'])->name('lr-role-um-sales-locations');

                Route::get('/um/dashboard/main/monitor-team-sales/view-sales/{agent_id}', [UnitManagerSalesReportController::class, 'view_member_sales'])->name('lr-role-um-view-member-sales');

                Route::get('/um/dashboard/team/statistics', [UnitManagerSalesTeamStatistics::class, 'team_chart_statistics'])->name('lr-role-um-team-chart-statistics');

                Route::get('/um/search-subteam-statistics', [SalesTeamStatistics::class, 'search_subteam_statistics'])->name('lr-role-um-search-subteam-statistics');

                Route::get('/um/dashboard/main/{filter_type}', [UnitManagerSalesReportController::class, 'get_top_dev_projects'])->name('lr-role-um-top-dev-projects');

                Route::get('/um/dashboard/subteam/members', [UnitManagerMemberController::class, 'sales_subteam_members'])->name('lr-role-um-sales-subteam-members');

                Route::get('/um/dashboard/subteam/data/members', [UnitManagerMemberController::class, 'sales_team_subteam_members_data'])->name('lr-role-um-sales-team-members-data');

                Route::get('/um/dashboard/subteam-recruits', [UnitManagerSalesTeamStatistics::class, 'team_recruits'])->name('lr-um-subteam-recruits');

                Route::get('/um/dashboard/downline', [UnitManagerMemberController::class, 'current_downline'])->name('lr-role-um-downline-status');

                Route::get('/um/dashboard/natcon-qualifiers', [UnitManagerMemberController::class, 'natcon_qualifiers'])->name('lr-role-um-natcon-qualifiers');

                Route::get('/um/dashboard/team/data/toppers', [UnitManagerMemberController::class, 'sales_team_top_ten'])->name('lr-role-um-sales-team-top-ten-data');

                Route::get('/um/dashboard/team/toppers', [UnitManagerMemberController::class, 'sales_team_toppers'])->name('lr-role-um-sales-team-toppers');

                Route::get('/um/dashboard/team/members', [UnitManagerMemberController::class, 'sales_team_members'])->name('lr-role-um-sales-team-members');

                Route::get('/um/dashboard/developers', [UnitManagerDeveloperController::class, 'index'])->name('lr-role-um-developer');

                Route::get('/um/dashboard/developer/{developer_id}', [UnitManagerDeveloperController::class, 'projects'])->name('lr-role-um-developer-projects');

                Route::get('/um/city/{province_id}', [AddressController::class, 'city'])->name('lr-um-role-city');

                Route::get('/um/barangay/{city_id}', [AddressController::class, 'barangay'])->name('lr-um-role-barangay');

                Route::get('/um/dashboard/projects-search', [UnitManagerProjectsController::class, 'index'])->name('lr-um-role-projects-search');

                Route::get('/um/dashboard/office-support', [UnitManagerOfficesController::class, 'officesearch'])->name('lr-um-role-dashboardoffices');

                Route::get('/um/dashboard/marketing-materials', [UnitManagerMarketingMaterialsController::class, 'index'])->name('lr-um-role-marketing-materials');

                Route::get('/um/dashboard/memo', [UnitManagerMarketingMaterialsController::class, 'memo'])->name('lr-um-role-memo');

                Route::get('/um/dashboard/training-videos', [UnitManagerTrainingVideosController::class, 'index'])->name('lr-um-role-training-videos');

                Route::get('/um/dashboard/upload-forms', [UnitManagerUploadFormsController::class, 'index'])->name('lr-um-role-uploadforms');

                Route::get('/um/dashboard/my-commissions', [UnitManagerCommissionController::class, 'my_commission'])->name('lr-um-role-my-commission');

                Route::get('/um/certificate-maker', [CertificateController::class, 'index'])->name('lr-certificate-maker');

                Route::get('/um/product-knowledge-seminar-maker', [PosterController::class, 'pks_maker'])->name('lr-pks-maker');

                Route::get('/um/ebook', [EbookController::class, 'index'])->name('lr-ebook');

                Route::get('/um/view-support-response', [UnitManagerCommentsController::class, 'view_support_response'])->name('lr-um-role-view-support-response');

                Route::get('/um/comment-details', [AgentCommentsController::class, 'comment_details'])->name('lr-um-role-comment-details');

                Route::get('/agent/tree-downline', [AgentMemberController::class, 'tree_downline'])->name('lr-agent-role-tree-downline');

                Route::get('/um/birthday-poster-generator', [BirthdayCelebrantsController::class, 'birthday_generator'])->name('lr-birthday-poster-generator');

                Route::middleware('xss')->group(function () {

                    Route::post('/um/add-sale', [DashboardController::class, 'store_sale'])->name('lr-um-role-add-sale');

                    Route::post('/um/add-comments', [CommentsController::class, 'add_comments'])->name('lr-um-role-comments-add');

                    Route::post('/um/update-profile', [MemberController::class, 'update_profile'])->name('lr-um-role-update');

                    Route::post('/um/change-profile-pic', [UnitManagerMemberController::class, 'change_profile'])->name('lr-um-change-profile-pic');

                    Route::post('/um/edit-pot', [SalesValidationController::class, 'update_pot'])->name('lr-um-role-update-pot');

                    Route::post('/um/update-comment', [AgentCommentsController::class, 'update_seen_status'])->name('lr-um-role-update-seen-status');
                });
            });

            // LR - SECRETARY ROLE DASHBOARD ---
            Route::middleware('auth.secretary')->group(function () {

                Route::get('/secretary/dashboard', [SecretaryDashboardController::class, 'index'])->name('lr-secretary-role-dashboard');

                Route::get('/secretary/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-secretary-role-birthday-celebrants');

                Route::get('/secretary/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-secretary-role-toppers');

                Route::get('/secretary/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-secretary-role-sales-team-toppers');

                Route::get('/secretary/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-secretary-role-prev-agent-toppers');

                Route::get('/secretary/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-secretary-role-prev-team-toppers');

                Route::get('/secretary/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-secretary-role-prev-brokerage-agent-toppers');

                Route::get('/secretary/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-secretary-role-dev-agent-toppers');

                Route::get('/secretary/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-secretary-role-dev-toppers');

                Route::get('/secretary/dashboard/property-types', [DashboardController::class, 'get_project_types'])->name('lr-secretary-role-property-types');

                Route::get('/secretary/dashboard/property-type/{prop_type_id}', [DashboardController::class, 'get_project_type'])->name('lr-agent-role-property-type');

                Route::get('/secretary/sales/source/{option}', [DashboardController::class, 'sales_source'])->name('lr-secretary-role-sales-source');

                Route::get('/secretary/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-secretary-role-project-type');

                Route::get('/secretary/developer/projects/{developer_id}', [DashboardController::class, 'developer_projects'])->name('lr-secretary-role-developer-projects');

                Route::get('/secretary/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-secretary-role-project-type');

                Route::get('/secretary/dashboard/project-search', [SecretaryProjectsController::class, 'search_project'])->name('lr-secretary-role-project-search');

                Route::get('/secretary/dashboard/my-sales', [SecretarySalesReportController::class, 'mysales'])->name('lr-secretary-role-mysales');

                Route::get('/secretary/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-secretary-role-dev-agent-toppers');

                Route::get('/secretary/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-secretary-role-dev-toppers');

                Route::get('/secretary/dashboard/developers', [SecretaryDeveloperController::class, 'index'])->name('lr-role-secretary-developer');

                Route::get('/secretary/city/{province_id}', [AddressController::class, 'city'])->name('lr-secretary-role-city');

                Route::get('/secretary/barangay/{city_id}', [AddressController::class, 'barangay'])->name('lr-secretary-role-barangay');

                Route::get('/secretary/dashboard/profile', [SecretaryMemberController::class, 'index'])->name('lr-secretary-role-profile');

                Route::get('/secretary/dashboard/profile/{member_id}', [SecretaryMemberController::class, 'member_profile'])->name('lr-secretary-role-profile-search');

                Route::get('/secretary/dashboard/my-commissions', [SecretaryCommissionController::class, 'my_commission'])->name('lr-secretary-role-my-commission');

                Route::get('/secretary/dashboard/downline', [SecretaryMemberController::class, 'get_current_downline'])->name('lr-role-secretary-downline-status');

                Route::get('/secretary/dashboard/team/data/{category}', [SupervisorMemberController::class, 'sales_team_members_data'])->name('lr-role-secretary-sales-team-members-data');

                Route::get('/secretary/dashboard/team/members', [SecretaryMemberController::class, 'sales_team_members'])->name('lr-role-secretary-sales-team-members');

                Route::get('/secretary/dashboard/team/toppers', [SecretaryMemberController::class, 'sales_team_toppers'])->name('lr-role-secretary-sales-team-toppers');

                Route::get('/secretary/dashboard/main', [SecretaryDashboardController::class, 'main_dashboard'])->name('lr-role-secretary-main-dashboard');

                Route::get('/secretary/dashboard/members', [SecretaryMemberController::class, 'members'])->name('lr-role-secretary-members');

                Route::get('/secretary/dashboard/sales-validation/{filter}', [SecretarySalesValidationController::class, 'index'])->name('lr-role-secretary-sales-validation');

                Route::get('/secretary/dashboard/sales-member-validation/{filter}/member-sales/{agent_id}', [SecretarySalesValidationController::class, 'member_sales'])->name('lr-role-secretary-sales-member-validation');

                Route::get('/sales-details', [SalesReportController::class, 'sales_details'])->name('lr-secretary-role-sales-details');

                Route::get('/secretary/dashboard/office-support', [SecretaryOfficesController::class, 'officesearch'])->name('lr-dashboardoffices');

                Route::get('/secretary/certificate-maker', [CertificateController::class, 'index'])->name('lr-certificate-maker');

                Route::get('/secretary/monthly-sellers-data', [SecretaryMemberController::class, 'monthly_sellers_data'])->name('lr-role-secretary-monthly-sellers-data');

                Route::get('/secretary/monthly-sellers', [SecretaryMemberController::class, 'monthly_sellers'])->name('lr-role-secretary-monthly-sellers');

                Route::get('/secretary/product-knowledge-seminar-maker', [PosterController::class, 'pks_maker'])->name('lr-pks-maker');

                Route::get('/secretary/natcon-member-toppers', [SecretaryMemberController::class, 'team_member_toppers'])->name('lr-role-secretary-natcon-member-toppers');

                Route::get('/secretary/natcon-agent-qualifiers', [SecretaryMemberController::class, 'filter_natcon_agent_qualifiers'])->name('lr-role-secretary-natcon-agent-qualifiers');

                Route::get('/secretary/natcon-agent-qualifiers/{year}', [SecretaryMemberController::class, 'filter_natcon_agent_qualifiers'])->name('lr-role-secretary-natcon-agent-qualifiers-year');

                Route::get('/secretary/sales-locations', [SalesLocationController::class, 'get_provinces_with_sales'])->name('lr-role-secretary-sales-locations');

                Route::get('/secretary/dashboard/upload-forms', [SecretaryUploadFormsController::class, 'index'])->name('lr-secretary-role-uploadforms');

                Route::get('/secretary/ebook', [EbookController::class, 'index'])->name('lr-ebook');

                Route::get('/secretary/birthday-poster-generator', [BirthdayCelebrantsController::class, 'birthday_generator'])->name('lr-birthday-poster-generator');

                Route::get('/secretary/monthly-awardees-poster', [PosterController::class, 'secretary_monthly_awardees_poster'])->name('lr-secretary-monthly-poster');

                Route::get('/secretary/location-awardees-poster-data', [PosterController::class, 'get_monthly_awardees_by_location'])->name('lr-sec-location-awardees-poster-data');

                Route::middleware('xss')->group(function () {

                    Route::post('/secretary/add-sale', [DashboardController::class, 'store_sale'])->name('lr-secretary-role-add-sale');

                    Route::post('/secretary/update-profile', [MemberController::class, 'update_profile'])->name('lr-secretary-role-update');

                    Route::post('/secretary/add-member', [SupervisorMemberController::class, 'add_team_member'])->name('lr-secretary-role-add-team-member');

                    Route::post('/secretary/edit-member', [SupervisorMemberController::class, 'update_team_member'])->name('lr-secretary-role-edit-team-member');

                    Route::post('/edit-pot', [SalesValidationController::class, 'update_pot'])->name('lr-secretary-role-update-pot');
                });
            });

            // LR - INACTIVE ROLE DASHBOARD ---
            Route::middleware('auth.inactive')->group(function () {

                Route::get('/inactive/dashboard', [InactiveDashboardController::class, 'index'])->name('lr-inactive-role-dashboard');

                Route::get('/inactive/dashboard/birthday-celebrants', [DashboardController::class, 'birthday_celebrants'])->name('lr-inactive-role-birthday-celebrants');

                Route::get('/inactive/dashboard/agent-toppers', [DashboardController::class, 'agent_toppers'])->name('lr-inactive-role-toppers');

                Route::get('/inactive/dashboard/sales-team-toppers', [DashboardController::class, 'sales_team_toppers'])->name('lr-inactive-role-sales-team-toppers');

                Route::get('/inactive/dashboard/agent-prev-toppers', [DashboardController::class, 'prev_agent_toppers'])->name('lr-inactive-role-prev-agent-toppers');

                Route::get('/inactive/dashboard/team-prev-toppers', [DashboardController::class, 'prev_team_toppers'])->name('lr-inactive-role-prev-team-toppers');

                Route::get('/inactive/dashboard/agent-brokerage-prev-toppers', [DashboardController::class, 'prev_brokerage_agent_toppers'])->name('lr-inactive-role-prev-brokerage-agent-toppers');

                Route::get('/inactive/dashboard/agent-dev-toppers', [DashboardController::class, 'agent_developer_toppers'])->name('lr-inactive-role-dev-agent-toppers');

                Route::get('/inactive/dashboard/dev-toppers', [DashboardController::class, 'developer_toppers'])->name('lr-inactive-role-dev-toppers');

                Route::get('/inactive/dashboard/profile', [InactiveMemberController::class, 'index'])->name('lr-agent-role-profile');

                Route::get('/inactive/view-support-response', [InactiveCommentsController::class, 'view_support_response'])->name('lr-inactive-role-view-support-response');

                Route::get('/inactive/comment-details', [AgentCommentsController::class, 'comment_details'])->name('lr-inactive-role-comment-details');

                Route::get('/inactive/project/property-type/{property_id}', [ProjectsController::class, 'property_type_search'])->name('lr-project-type');

                Route::get('/inactive/project/province/{province_id}', [ProjectsController::class, 'province_search'])->name('lr-project-type');

                Route::get('/inactive/project/city/{city_id}', [ProjectsController::class, 'city_search'])->name('lr-project-type');

                Route::get('/inactive/dashboard/project-search', [InactiveProjectsController::class, 'search_project'])->name('lr-inactive-role-project-search');

                Route::get('/inactive/dashboard/developer/{developer_id}', [InactiveDeveloperController::class, 'projects'])->name('lr-inactive-role-developer-projects-1');

                Route::get('/inactive/dashboard/fetch_fire_certs', [InactiveMemberController::class, 'fetch_fire_certs']);

                Route::get('/nao-video-presentation', [InactiveDashboardController::class, 'nao_video_presentation'])->name('nao-vid-pres');

                Route::get('/fetch-video-file', [InactiveDashboardController::class, 'fetch_video_file'])->name('nao-vid-file');

                Route::middleware('xss')->group(function () {

                    Route::post('/inactive/add-comments', [CommentsController::class, 'add_comments'])->name('lr-inactive-role-comments-add');

                    Route::post('/inactive/update-profile', [MemberController::class, 'update_profile'])->name('lr-inactive-role-update');

                    Route::post('/inactive/update-comment', [AgentCommentsController::class, 'update_seen_status'])->name('lr-inactive-role-update-seen-status');

                    Route::post('/inactive/save-vid-watched-time', [InactiveDashboardController::class, 'save_vid_watched_time'])->name('lr-inactive-save-vid-watched-time');
                });
            });

            // LR - EDITOR ROLE DASHBOARD ---
            Route::middleware('auth.editor')->group(function () {

                Route::get('/editor/dashboard', [EditorDashboarddController::class, 'index'])->name('lr-editor-role-dashboard');

                Route::get('/dashboard/editor/projectsid', [EditorDashboarddController::class, 'edit_project_data'])->name('lr-editor-projectsid');

                Route::get('/dashboard/editor/get-project-info/{project_id}', [EditorDashboarddController::class, 'get_project_info'])->name('lr-editor-get-project-info');

                Route::get('/editor/city_project_edit/{province_id}', [AddressController::class, 'city_project_edit'])->name('lr-city');

                Route::get('/editor/barangay_project_edit/{city_id}', [AddressController::class, 'barangay_project_edit'])->name('lr-barangay');

                Route::get('/editor/developer/{developer_id}', [EditorDashboarddController::class, 'developer_profile'])->name('lr-developer_profile');

                Route::get('/editor/city/{province_id}', [AddressController::class, 'city'])->name('lr-city');

                Route::get('/editor/barangay/{city_id}', [AddressController::class, 'barangay'])->name('lr-barangay');

                Route::post('/editor/edit-developer', [EditorDashboarddController::class, 'edit_developer'])->name('lr-editor-developer-info-edit');

                Route::post('/editor/edit-developer', [DeveloperController::class, 'edit_developer'])->name('lr-editor-developer-info-edit');

                Route::post('/editor/edit-project', [ProjectsController::class, 'project_edit'])->name('lr-editor-project-info-edit');

                Route::middleware('xss')->group(function () {

                    Route::post('/editor/add-sale', [EditorDashboarddController::class, 'store_sale'])->name('lr-editor-role-add-sale');

                    Route::post('/editor/add-project', [EditorDashboarddController::class, 'store_project'])->name('lr-editor-developer-add-project');
                });
            });
        });
    });
});
