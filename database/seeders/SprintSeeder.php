namespace Database\Seeders;

use App\Models\Sprint;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SprintSeeder extends Seeder
{
    public function run()
    {
        $sprint = Sprint::create([
            'name' => 'Sprint 23 - E-commerce Platform',
            'description' => 'Implementation of core e-commerce features',
            'start_date' => Carbon::now()->startOfWeek(),
            'end_date' => Carbon::now()->addWeeks(2)->endOfWeek(),
            'is_active' => true,
        ]);

        $tasks = [
            [
                'task_id' => 'US-001',
                'title' => 'User Registration System',
                'description' => 'Implement user registration with email verification and password validation',
                'status' => 'backlog',
                'priority' => 'low',
                'story_points' => 8,
                'assignee_name' => 'John Doe',
                'position' => 0,
            ],
            [
                'task_id' => 'US-002',
                'title' => 'Product Search Feature',
                'description' => 'Add advanced search functionality with filters and sorting options',
                'status' => 'backlog',
                'priority' => 'medium',
                'story_points' => 13,
                'assignee_name' => 'Anna Smith',
                'position' => 1,
            ],
            [
                'task_id' => 'BUG-001',
                'title' => 'Fix Payment Gateway',
                'description' => 'Resolve critical issue with payment processing timeout',
                'status' => 'backlog',
                'priority' => 'high',
                'story_points' => 5,
                'assignee_name' => 'Mike Johnson',
                'position' => 2,
            ],
            [
                'task_id' => 'US-003',
                'title' => 'Shopping Cart UI',
                'description' => 'Design and implement responsive shopping cart interface',
                'status' => 'todo',
                'priority' => 'medium',
                'story_points' => 5,
                'assignee_name' => 'Lisa Brown',
                'position' => 0,
            ],
            [
                'task_id' => 'US-004',
                'title' => 'Email Notifications',
                'description' => 'Set up automated email notifications for order confirmations',
                'status' => 'todo',
                'priority' => 'low',
                'story_points' => 3,
                'assignee_name' => 'Robert Wilson',
                'position' => 1,
            ],
            [
                'task_id' => 'US-005',
                'title' => 'Database Optimization',
                'description' => 'Optimize database queries and implement caching mechanism',
                'status' => 'progress',
                'priority' => 'high',
                'story_points' => 8,
                'assignee_name' => 'Tom Garcia',
                'position' => 0,
            ],
            [
                'task_id' => 'US-006',
                'title' => 'Mobile Responsiveness',
                'description' => 'Ensure all pages are fully responsive on mobile devices',
                'status' => 'progress',
                'priority' => 'medium',
                'story_points' => 5,
                'assignee_name' => 'Emma Miller',
                'position' => 1,
            ],
            [
                'task_id' => 'US-007',
                'title' => 'User Profile Management',
                'description' => 'Allow users to edit their profile information and preferences',
                'status' => 'testing',
                'priority' => 'low',
                'story_points' => 3,
                'assignee_name' => 'David Jones',
                'position' => 0,
            ],
            [
                'task_id' => 'US-008',
                'title' => 'Login Authentication',
                'description' => 'Implement secure user login with JWT tokens',
                'status' => 'done',
                'priority' => 'medium',
                'story_points' => 5,
                'assignee_name' => 'Sarah Wilson',
                'position' => 0,
            ],
            [
                'task_id' => 'US-009',
                'title' => 'Product Catalog Display',
                'description' => 'Create product listing page with grid layout and pagination',
                'status' => 'done',
                'priority' => 'low',
                'story_points' => 8,
                'assignee_name' => 'Kevin Lee',
                'position' => 1,
            ],
        ];

        foreach ($tasks as $taskData) {
            $sprint->tasks()->create($taskData);
        }
    }
}