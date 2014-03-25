<?php
/**
* PHP_Fork class usage examples
* ==================================================================================
* NOTE: In real world you surely want to keep each class into
* a separate file, then include() it into your application.
* For this examples is more useful to keep all_code_into_one_file,
* so that each example shows a unique feature of the PHP_Fork framework.
* ==================================================================================
* browser_pool.php
*
* This example show a "real" usage example: a command line interactive
* tool that sends cuncurrent requests to a given URL, using a dynamic
* process pool.
* The pool start size is defined into the constant NUM_START_THREAD
* The application show a simple CLI prompt, user can type an URL
* and the number of requests to perform.
* The application takes care of forking processes (when needed),
* sending requests and collect results.
* Min, max and average response times are reported.
*
* This example requires the Snoopy class (http://sourceforge.net/project/?group_id=2091)
*
* ==================================================================================
*
*/

// Import of base class
require_once ("PHP/Fork.php");
require_once ("Snoopy.class.php");

// number of executeThreads we want at start
define ("NUM_START_THREAD", 2);

// this is needed as PHP 4.3 in order to use pcntl_signal()
declare (ticks = 1);

/**
* Classes definition. In real world you surely want to keep each class into
* a separate file, then include() it into your application.
* For this examples is more useful to keep all_code_into_one_file
*
* executeThread class inherit from PHP_Fork and must redefine the run() method
* all the code contained into the run() method will be executed only by the child
* process; all other methods that you define will be accessible both to the parent
* and to the child (and will be executed into the relative process)
*/

class executeThread extends PHP_Fork {
        var $request;

        function executeThread($name)
        {
                $this->PHP_Fork($name);
        }

        function run()
        {
                while (true) {
                        sleep(1);
                }
        }

        function sendRequest($val)
        {
                if ($this->_isChild) {
                        $snoopy = new Snoopy;
                        $time_start = $this->microtime_float();

                        $snoopy->fetchtext($val[0]);
                        return ($this->microtime_float() - $time_start)*1000;
                }
                /**
                * Never change this line, it requires no adjustments...
                */
                else return $this->register_callback_func(func_get_args(), __FUNCTION__);
        }
        function microtime_float()
        {
                list($usec, $sec) = explode(" ", microtime());
                return ((float)$usec + (float)$sec);
        }

        function getCounter($params)
        {
                if ($this->_isChild) {
                        return $GLOBALS["counter"];
                } else return $this->register_callback_func(func_get_args(), __FUNCTION__);
        }
}

function showHelpMsg()
{
        print "Type an URL followed by a space and the number of cuncurrent requests you wish to perform, or type [X] to terminate.\n";
}

/**
* Main program. Bring up two instances of the executeThread class that
* runs concurrently. It's a multi-thread app with a few lines of code!!!
* executeThread does nothing interesting, it simply has a counter and increment
* this counter each second... (see class definition at top of this file)
*/
for ($i = 0;$i < NUM_START_THREAD;$i++) {
        $executeThread[$i] = &new executeThread ("httpClient-" . $i);
        $executeThread[$i]->start();
        echo "Started " . $executeThread[$i]->getName() . " with PID " . $executeThread[$i]->getPid() . "...\n";
}
print "This is the main process.\n";
showHelpMsg();
/**
* Console simple listener
*/
$fp = fopen("php://stdin","r");
while (true) {
        echo ">";
        $cmdline = trim(fgets($fp,1024));
        if ($cmdline == "") {
                showHelpMsg();
                continue;
        }

        list ($url, $numreq) = explode (" ",$cmdline);
        // on user request exit
        if ( empty($numreq) && ( $url == 'X' || $url == 'x'))
        {
                foreach ($executeThread as $thread) {
                        $thread->stop();
                        echo "Stopped " . $thread->getName() . "\n";
                }
                exit;
        }


        // spawn so many childs to reach $numreq
        while (count($executeThread) < $numreq)
        {
                $i = count($executeThread);
                $executeThread[$i] = &new executeThread ("httpClient-" . $i);
                $executeThread[$i]->start();
                print time() . "- New instance successfully spawned (NAME=".$executeThread[$i]->getName().",PID=" . $executeThread[$i]->getPid() . ")\n";

        }
        echo "Please wait .";
        $i=0;
        while($i<5)
        {
                echo ".";
                $i++;
                sleep(1);
        }
        echo "\nSending requests...\n";
        $responeTimes = array();

        foreach ($executeThread as $idx=>$thread) {
                $responeTimes[] =$executeThread[$idx]->sendRequest($url,PHP_FORK_RETURN_METHOD);
        }
        sort ($responeTimes, SORT_NUMERIC);
        echo "Fastest request time (msecs): ".$responeTimes[0]."\n";
        echo "Longest request time (msecs): ".$responeTimes[count($responeTimes)-1]."\n";
        echo "Average request time (msecs): ".(array_sum($responeTimes)/count($responeTimes))."\n";



}

fclose($fp);