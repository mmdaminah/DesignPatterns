<?php

namespace Composite {
    abstract class Employee
    {
        public function __construct(private $name, private $salary)
        {
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getSalary()
        {
            return $this->salary;
        }

        public function setSalary($salary): void
        {
            $this->salary = $salary;
        }
    }

    class Developer extends Employee
    {
        private $stack;

        public function getStack()
        {
            return $this->stack;
        }

        public function setStack($stack): void
        {
            $this->stack = $stack;
        }
    }

    class Designer extends Employee
    {
        private $gender;

        public function getGender()
        {
            return $this->gender;
        }

        public function setGender($gender): void
        {
            $this->gender = $gender;
        }
    }

    class Organization
    {
        protected $employees = [];

        public function addEmployee(Employee $employee)
        {
            $this->employees[] = $employee;
        }

        public function getNetSalaries()
        {
            $netSalary = 0;
            foreach ($this->employees as $employee)
                $netSalary += $employee->getSalary();
            return $netSalary;
        }
    }

    $john = new Developer('John Doe', 12000);
    $jane = new Designer('Jane Doe', 15000);

    // Add them to organization
    $organization = new Organization();
    $organization->addEmployee($john);
    $organization->addEmployee($jane);

    echo "Net salaries: " . $organization->getNetSalaries();
}
