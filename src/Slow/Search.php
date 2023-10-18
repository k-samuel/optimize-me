<?php
declare(strict_types=1);

namespace KSamuel\OptimizeMe\Slow;

use KSamuel\OptimizeMe\SearchInterface;
use KSamuel\OptimizeMe\WriterInterface;


class Search implements SearchInterface
{
    public function search(string $filePath, WriterInterface $writer): void
    {
        if (!file_exists($filePath)) {
            trigger_error("File " . $filePath . " not found");
        }

        $data = file_get_contents($filePath);
        $lines = explode("\n", $data);

        /**
         * @var array<User>
         */
        $users = [];
        /**
         * @var array<string>
         */
        $seenBrowsers = [];
        $uniqueBrowsers = 0;
        $foundUsers = '';

        foreach ($lines as $line) {
            $users[] = User::fromArray(json_decode($line, true));
        }

        foreach ($users as $i => $user) {

            $isAndroid = false;

            foreach ($user->getBrowsers() as $browser) {
                preg_match('/(Android)/', $browser, $matches);
                if (!empty($matches)) {
                    $isAndroid = true;
                    $notSeenBefore = true;
                    foreach ($seenBrowsers as $item) {
                        if ($item === $browser) {
                            $notSeenBefore = false;
                        }
                    }
                    if ($notSeenBefore) {
                        $seenBrowsers[] = $browser;
                        $uniqueBrowsers++;
                    }
                }
            }

            $isMSIE = false;

            foreach ($user->getBrowsers() as $browser) {
                preg_match('/(MSIE)/', $browser, $matches);
                if (!empty($matches)) {
                    $isMSIE = true;
                    $notSeenBefore = true;
                    foreach ($seenBrowsers as $item) {
                        if ($item === $browser) {
                            $notSeenBefore = false;
                        }
                    }
                    if ($notSeenBefore) {
                        $seenBrowsers[] = $browser;
                        $uniqueBrowsers++;
                    }
                }
            }

            if (!($isAndroid && $isMSIE)) {
                continue;
            }

            $email = preg_replace('/(@)/', ' [at] ', $user->getEmail());
            $foundUsers .= sprintf("[%d] %s <%s>\n", $i, $user->getName(), $email);
        }

        $writer->write("found users:\n" . $foundUsers . "\n");
        $writer->write("Total unique browsers " . $uniqueBrowsers . "\n");
    }
}
