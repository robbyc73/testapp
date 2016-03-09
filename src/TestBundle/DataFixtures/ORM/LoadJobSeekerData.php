<?php

namespace TestBundle\DataFixtures\ORM;

use TestBundle\Entity\JobSeeker;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadJobSeekerData extends AbstractFixture implements OrderedFixtureInterface 
{

	public function load(ObjectManager $manager) 
	{

                $jsdata = array(array('name' => 'Rob', 'surname' => 'Campbell', 'dob' => '1973-09-27'), 
                                array('name' => 'Hsiu', 'surname' => 'Wong', 'dob' => '1980-02-14'), 
                                array('name' => 'Heng', 'surname' => 'Heng', 'dob' => '1980-02-14'));

                for($i =0; $i < sizeof($jsdata); $i++) {
			$js = new JobSeeker();
                	$js->setName($jsdata[$i]['name']);
			$js->setSurname($jsdata[$i]['surname']);
                	$js->setDOB(new \DateTime($jsdata[$i]['dob']));
                        $manager->persist($js);
                        
		}
		$manager->flush();

	}

	public function getOrder()
	{
		return 1;
	}
}

