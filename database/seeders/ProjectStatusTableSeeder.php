<?php

namespace Database\Seeders;

use App\Models\ProjectStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        try {
            DB::beginTransaction();

            $this->createProjectStatus();
            DB::commit();
            $this->command->info('Project status successfully seeded.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }




    public function createProjectStatus()
    {
        $projectStatusDatas = $this->projectStatus();

        foreach ($projectStatusDatas as $projectStatusData) {
            $projectStatusData = (object) $projectStatusData;

            $projectStatus = new ProjectStatus();

            $projectStatus->name = $projectStatusData->name;
            $projectStatus->color = $projectStatusData->color;
            $projectStatus->status = $projectStatusData->status;
            $projectStatus->send_sms = $projectStatusData->send_sms;
            $projectStatus->sms_body = $projectStatusData->sms_body;
            $projectStatus->send_email = $projectStatusData->send_email;
            $projectStatus->email_body = $projectStatusData->email_body;
            $projectStatus->save();
        }

        return true;
    }

    private function projectStatus()
    {
        $datas = [
            [
                "name" => "Not Started",
                "color" => "#9E9E9E",
                "send_sms" => "No",
                "sms_body" => "",
                "send_email" => "Yes",
                "email_body" => "Hello Sir, your project is scheduled to begin soon. We'll keep you updated!",
                "status" => "Active"
            ],
            [
                "name" => "Planning",
                "color" => "#2196F3",
                "send_sms" => "No",
                "sms_body" => "",
                "send_email" => "Yes",
                "email_body" => "Dear Sir, we're currently in the planning phase for. Requirements are being finalized.",
                "status" => "Active"
            ],
            [
                "name" => "In Progress",
                "color" => "#FF9800",
                "send_sms" => "Yes",
                "sms_body" => "Hi Sir, work on is actively progressing. Check email for weekly update.",
                "send_email" => "Yes",
                "email_body" => "Hello Sir, here's your weekly progress update for. We're making great headway!",
                "status" => "Active"
            ],
            [
                "name" => "On Hold",
                "color" => "#FF5722",
                "send_sms" => "Yes",
                "sms_body" => "Hi Sir, project is temporarily on hold. We'll notify when it resumes.",
                "send_email" => "Yes",
                "email_body" => "Dear Sir, project has been placed on hold pending further information/approval.",
                "status" => "Active"
            ],
            [
                "name" => "Review",
                "color" => "#FFC107",
                "send_sms" => "Yes",
                "sms_body" => "Hi Sir, project is ready for your review. Please check your email.",
                "send_email" => "Yes",
                "email_body" => "Dear Sir, project is now in review phase. Please provide your feedback.",
                "status" => "Active"
            ],
            [
                "name" => "Testing",
                "color" => "#9C27B0",
                "send_sms" => "No",
                "sms_body" => "",
                "send_email" => "Yes",
                "email_body" => "Hello Sir, project is currently in testing phase. Quality checks underway.",
                "status" => "Active"
            ],
            [
                "name" => "Completed",
                "color" => "#4CAF50",
                "send_sms" => "Yes",
                "sms_body" => "Great news! Project has been completed successfully. Check email for details.",
                "send_email" => "Yes",
                "email_body" => "Congratulations Sir! Project has been completed successfully. Thank you for your partnership!",
                "status" => "Active"
            ],
            [
                "name" => "Delivered",
                "color" => "#009688",
                "send_sms" => "Yes",
                "sms_body" => "Project has been delivered! Final documents in your email.",
                "send_email" => "Yes",
                "email_body" => "Dear Sir, project has been delivered. All final documents are attached.",
                "status" => "Active"
            ],
            [
                "name" => "Cancelled",
                "color" => "#F44336",
                "send_sms" => "Yes",
                "sms_body" => "Project has been cancelled as requested. Contact us with any questions.",
                "send_email" => "Yes",
                "email_body" => "Dear Sir, project has been cancelled. Please contact us if you have any questions.",
                "status" => "Active"
            ],
            [
                "name" => "Archived",
                "color" => "#607D8B",
                "send_sms" => "No",
                "sms_body" => "",
                "send_email" => "No",
                "email_body" => "",
                "status" => "Inactive"
            ]
        ];

        return $datas;
    }

}
