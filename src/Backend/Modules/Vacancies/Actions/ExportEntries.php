<?php

namespace Backend\Modules\Vacancies\Actions;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Engine\Base\Action as BackendBaseAction;
use Backend\Core\Engine\Csv as BackendCSV;
use Backend\Modules\Vacancies\Engine\Entries as BackendVacanciesEntriesModel;
use Backend\Modules\Vacancies\Engine\Model as BackendVacanciesModel;

/**
 * This action is used to export submissions of a form.
 */
class ExportEntries extends BackendBaseAction
{

    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $this->id = $this->getParameter('id', 'int', null);
        if ($this->id == null || !BackendVacanciesModel::exists($this->id)) {
            $this->redirect(
                Model::createURLForAction('Index') . '&error=non-existing'
            );
        }

        $data = BackendVacanciesEntriesModel::getAllForVacancy($this->id);


        BackendCSV::outputCSV(date('Ymd_His') . '.csv', $data, null, array('id', 'file'));
    }
}
