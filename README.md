# Async command bus


### Setup
Create config file `config/services/async_command_bus.yaml`

### Full config example
```yaml
async_command_bus:
  connections:
    default:
      host: 'localhost'
      port: 5672
      user: 'guest'
      password: 'guest'
    second:
      host: 'localhost'
      port: 5672
      user: 'guest'
      password: 'guest'
      vhost: 'test_vhost'
  exchanges:
    test_exchange_name:
      connection: second
      name: test_exchange
      type: direct
  queues:
    first_queue_name:
      connection: default
      name: first_queue
    second_queue_name:
      connection: second
      name: second_queue
      passive: false
      durable: false
      exclusive: false
      auto_delete: false
  bindings:
    test_binding:
      queue: second_queue_name
      exchange: test_exchange_name
      routing_key: test_routing_key
  commands:
    command_published_to_queue:
      class: FirstTestClass
      publisher:
        queue: first_queue_name
    command_published_to_exchange:
      class: SecondTestClass
      publisher:
        exchange:
          name: test_exchange_name
          routing_key: test_routing_key
```