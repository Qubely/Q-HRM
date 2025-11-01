<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\IBaseRepository;
use Illuminate\Support\ServiceProvider;
//vpx_imports
use App\Repositories\Admin\DataLibrary\Inventory\Category\Crud\ILibInventoryCatCrudRepository;
use App\Repositories\Admin\DataLibrary\Inventory\Category\Crud\LibInventoryCatCrudRepository;
use App\Repositories\Admin\Attendance\Reconciliation\Dt\EmployeeRecon\IEmployeeReconDtRepository;
use App\Repositories\Admin\Attendance\Reconciliation\Dt\EmployeeRecon\EmployeeReconDtRepository;
use App\Repositories\Employee\Attendance\Reports\Monthly\Details\Modal\AddReconciliation\IAddReconciliationRepository;
use App\Repositories\Employee\Attendance\Reports\Monthly\Details\Modal\AddReconciliation\AddReconciliationRepository;
use App\Repositories\Employee\Attendance\Reconciliation\Dt\ReconHistory\IReconHistoryDtRepository;
use App\Repositories\Employee\Attendance\Reconciliation\Dt\ReconHistory\ReconHistoryDtRepository;
use App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise\IMonthWiseLoadRepository;
use App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise\MonthWiseLoadRepository;
use App\Repositories\Employee\Attendance\Entry\Form\Store\IEmployeeAttendanceEntryStoreRepository;
use App\Repositories\Employee\Attendance\Entry\Form\Store\EmployeeAttendanceEntryStoreRepository;
use App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\IActiveEmployeeDtRepository;
use App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\ActiveEmployeeDtRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee\IViewDraftEmployeeRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee\ViewDraftEmployeeRepository;
use App\Repositories\Admin\Employee\Draft\Crud\SalarySetup\Form\Update\IEmployeeSalarySalarySetupUpdateRepository;
use App\Repositories\Admin\Employee\Draft\Crud\SalarySetup\Form\Update\EmployeeSalarySalarySetupUpdateRepository;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem\IRefreshSalaryItemRepository;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem\RefreshSalaryItemRepository;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\ILibSalaryGroupCrudRepository;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\LibSalaryGroupCrudRepository;
use App\Repositories\Admin\DataLibrary\Banks\Crud\ILibBankCrudRepository;
use App\Repositories\Admin\DataLibrary\Banks\Crud\LibBankCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\BankDetails\Form\Update\IEmployeeBankDetailsUpdateRepository;
use App\Repositories\Admin\Employee\Draft\Crud\BankDetails\Form\Update\EmployeeBankDetailsUpdateRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Leave\Crud\IEmployeeLeaveCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Leave\Crud\EmployeeLeaveCrudRepository;
use App\Repositories\Admin\DataLibrary\Dgree\Crud\ILibDgreeCrudRepository;
use App\Repositories\Admin\DataLibrary\Dgree\Crud\LibDgreeCrudRepository;
use App\Repositories\Admin\DataLibrary\Board\Crud\ILibBoardCrudRepository;
use App\Repositories\Admin\DataLibrary\Board\Crud\LibBoardCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Education\Crud\IEmployeeEducationCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\Education\Crud\EmployeeEducationCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update\IEmployeeUpdateRepository;
use App\Repositories\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update\EmployeeUpdateRepository;
use App\Repositories\Admin\Employee\Draft\Crud\IEmployeeCrudRepository;
use App\Repositories\Admin\Employee\Draft\Crud\EmployeeCrudRepository;
use App\Repositories\Admin\DataLibrary\Leave\Crud\ILibLeaveCrudRepository;
use App\Repositories\Admin\DataLibrary\Leave\Crud\LibLeaveCrudRepository;
use App\Repositories\Admin\DataLibrary\Department\Crud\ILibDepartmentCrudRepository;
use App\Repositories\Admin\DataLibrary\Department\Crud\LibDepartmentCrudRepository;
use App\Repositories\Admin\DataLibrary\Designation\Crud\ILibDesignationCrudRepository;
use App\Repositories\Admin\DataLibrary\Designation\Crud\LibDesignationCrudRepository;
use App\Repositories\Admin\DataLibrary\Salary\Heads\Crud\ILibSalaryHeadCrudRepository;
use App\Repositories\Admin\DataLibrary\Salary\Heads\Crud\LibSalaryHeadCrudRepository;
use App\Repositories\Admin\System\User\Policy\IAdminUserPolicyRepository;
use App\Repositories\Admin\System\User\Policy\AdminUserPolicyRepository;
use App\Repositories\Admin\System\User\UserRole\Crud\IAdminUserRoleCrudRepository;
use App\Repositories\Admin\System\User\UserRole\Crud\AdminUserRoleCrudRepository;
use App\Repositories\Admin\System\User\Crud\IAdminUserCrudRepository;
use App\Repositories\Admin\System\User\Crud\AdminUserCrudRepository;
class RepositoryServiceProvider extends ServiceProvider
{
        /**
         * Register any application services.
         */
        public function register(): void
        {
            $this->app->bind(abstract: IBaseRepository::class, concrete: BaseRepository::class);
            //vpx_attach
            $this->app->bind(abstract: ILibInventoryCatCrudRepository::class, concrete: LibInventoryCatCrudRepository::class);
            $this->app->bind(abstract: IEmployeeReconDtRepository::class, concrete: EmployeeReconDtRepository::class);
            $this->app->bind(abstract: IAddReconciliationRepository::class, concrete: AddReconciliationRepository::class);
            $this->app->bind(abstract: IReconHistoryDtRepository::class, concrete: ReconHistoryDtRepository::class);
            $this->app->bind(abstract: IMonthWiseLoadRepository::class, concrete: MonthWiseLoadRepository::class);
            $this->app->bind(abstract: IEmployeeAttendanceEntryStoreRepository::class, concrete: EmployeeAttendanceEntryStoreRepository::class);
            $this->app->bind(abstract: IActiveEmployeeDtRepository::class, concrete: ActiveEmployeeDtRepository::class);
            $this->app->bind(abstract: IViewDraftEmployeeRepository::class, concrete: ViewDraftEmployeeRepository::class);
            $this->app->bind(abstract: IEmployeeSalarySalarySetupUpdateRepository::class, concrete: EmployeeSalarySalarySetupUpdateRepository::class);
            $this->app->bind(abstract: IRefreshSalaryItemRepository::class, concrete: RefreshSalaryItemRepository::class);
            $this->app->bind(abstract: ILibSalaryGroupCrudRepository::class, concrete: LibSalaryGroupCrudRepository::class);
            $this->app->bind(abstract: ILibBankCrudRepository::class, concrete: LibBankCrudRepository::class);
            $this->app->bind(abstract: IEmployeeBankDetailsUpdateRepository::class, concrete: EmployeeBankDetailsUpdateRepository::class);
            $this->app->bind(abstract: IEmployeeLeaveCrudRepository::class, concrete: EmployeeLeaveCrudRepository::class);
            $this->app->bind(abstract: ILibDgreeCrudRepository::class, concrete: LibDgreeCrudRepository::class);
            $this->app->bind(abstract: ILibBoardCrudRepository::class, concrete: LibBoardCrudRepository::class);
            $this->app->bind(abstract: IEmployeeEducationCrudRepository::class, concrete: EmployeeEducationCrudRepository::class);
            $this->app->bind(abstract: IEmployeeUpdateRepository::class, concrete: EmployeeUpdateRepository::class);
            $this->app->bind(abstract: IEmployeeCrudRepository::class, concrete: EmployeeCrudRepository::class);
            $this->app->bind(abstract: ILibLeaveCrudRepository::class, concrete: LibLeaveCrudRepository::class);
            $this->app->bind(abstract: ILibDepartmentCrudRepository::class, concrete: LibDepartmentCrudRepository::class);
            $this->app->bind(abstract: ILibDesignationCrudRepository::class, concrete: LibDesignationCrudRepository::class);
            $this->app->bind(abstract: ILibSalaryHeadCrudRepository::class, concrete: LibSalaryHeadCrudRepository::class);
            $this->app->bind(abstract: IAdminUserPolicyRepository::class, concrete: AdminUserPolicyRepository::class);
            $this->app->bind(abstract: IAdminUserRoleCrudRepository::class, concrete: AdminUserRoleCrudRepository::class);
            $this->app->bind(abstract: IAdminUserCrudRepository::class, concrete: AdminUserCrudRepository::class);
        }
}
