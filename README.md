## Setup
```bash
git clone https://github.com/jaffarkamarudheen/RTB.git
cd real-time-bidding
docker-compose up -d --build
docker-compose run --rm app composer install
docker-compose run --rm app php artisan migrate --seed

# Queue worker
docker-compose run --rm app php artisan queue:work

# Scheduler
docker-compose run --rm app php artisan schedule:work

#Demo user
Admin: username : admin@example.com / password : password





##approach


 "The system implements an event-driven Laravel architecture using Redis queues for concurrent bid processing, automated scheduler-based evaluations, and strict validation rules to ensure data integrity while prioritizing scalability through containerized microservices.

For a slightly more detailed version (2 sentences):

The solution combines Laravel's queue system with Redis for high-performance bid processing and a scheduler-based evaluation engine that automatically awards slots to the highest bidder. Built with API-first design principles and Docker containers, it ensures reliable concurrency handling while maintaining strict validation and audit trails throughout the bidding lifecycle.

Both versions capture:

Core technology choices (Laravel/Redis/Docker)

Key mechanisms (queues/scheduler)

Architectural priorities (concurrency/data integrity)

System behavior (automated evaluations)

Deployment approach (containerized)"
