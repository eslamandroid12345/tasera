<?php

namespace App\Console\Commands;
use App\Repository\StructureRepositoryInterface;
use Mail;
use App\Jobs\SendEmailsWeekly;
use Illuminate\Console\Command;
use App\Repository\UserRepositoryInterface;

class SendWeeklyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'email:send-weekly';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Send weekly emails to users';

    /**
     * Execute the console command.
     */

     public function __construct(
        private readonly UserRepositoryInterface $userRepository,
         private readonly StructureRepositoryInterface $structureRepository,
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = $this->userRepository->getAllUserBuyerReport();
        $infos = json_decode($this->structureRepository->structure('infos')->content, true);
        foreach ($users as $user)
        {
            dispatch(new SendEmailsWeekly($user->company->purchaseOrders,$user->email, $infos, $user->company->t('name')));
            // SendEmailsWeekly::dispatch($user)->onQueue('emails');
            // sleep(3);
        }

        $this->info('Weekly emails sent successfully!');
    }
}
